#!/usr/bin/env python
# coding: utf-8

# In[1]:


import pandas as pd
import numpy as np
import traceback
import joblib
import sys

from time import time

from sklearn.feature_selection import SelectKBest, f_classif
from sklearn.ensemble import RandomForestClassifier, GradientBoostingClassifier
from sklearn.linear_model import LogisticRegression
from sklearn.svm import SVC
from sklearn.neural_network import MLPClassifier

from sklearn.model_selection import GridSearchCV, train_test_split
from sklearn.metrics import accuracy_score, precision_score, recall_score, f1_score
from sklearn.preprocessing import StandardScaler
from sklearn import preprocessing

import warnings
warnings.filterwarnings('ignore', category=FutureWarning)
warnings.filterwarnings('ignore', category=DeprecationWarning)


try:

	# In[2]:


	def load_dataset(dataset):

		try:
			
			data = pd.read_csv(dataset)
			return data
		
		except IOError as e:
			
			print("Error: Unable to find the specified file!")


	# In[3]:


	def get_missing_data_percentage(data):
		
		# where mvp = missing value percentages
		mvp = data.isnull().sum() * 100 / len(data)
		mvp = pd.DataFrame({'Feature': data.columns,'Percentage': mvp})
		
		return mvp


	# In[4]:


	def drop_high_missing_data_columns(mvd, data):
		
		# Where "mvd" = missing value data
		# Get names of indexes for which column missing data is over 50%
		high_missing_data_cols = mvd[mvd['Percentage'] > 50].index

		for col_name in range(len(high_missing_data_cols)):
			del data[high_missing_data_cols[col_name]] # Delete rows from dataFrame
		
		return data


	# In[5]:


	def impute_low_missing_data_columns(mvd, data):

		# Get names of indexes for which column missing data is over 50%
		low_missing_data_cols = mvd[mvd['Percentage'] != 0].index

		for col_names in range(len(low_missing_data_cols)):

			feature = data[low_missing_data_cols[col_names]].name

			meanA = data[feature].mean()
			data[feature] = data[feature].fillna(meanA)

			meanB = data[feature].mean()
			data[feature] = data[feature].fillna(meanB)
		
		return traindata


	# In[6]:


	# Correct columns with a mixture of numerical and textual values
	def correct_mixed_value_columns(data):
		
		data.dependency = data.dependency.replace({"yes": 1, "no": 0}).astype(np.float64)
		data.edjefe = data.edjefe.replace({"yes": 1, "no": 0}).astype(np.float64)
		data.edjefa = data.edjefa.replace({"yes": 1, "no": 0}).astype(np.float64)
		#data.select_dtypes(include=[np.object]).head()
		
		return data


	# In[7]:


	def correct_inconsistent_households(data):
		
		# Find households with inconsistent poverty classes among its members
		contradictoryhouseholds = data.groupby('idhogar')['Target'].apply(lambda x: x.nunique() == 1)
		contradictoryhouseholds = contradictoryhouseholds[contradictoryhouseholds != True]
		#print("\nBefore Correction: Number of households with inconsistent poverty classes: "+str(contradictoryhouseholds.count())+"")
		
		# Iterate through each household and correct the inconsistent target values
		for household in contradictoryhouseholds.index:
			correctPovertyClass = int(data[(data['idhogar'] == household) & (data['parentesco1'] == 1.0)]['Target'])
			data.loc[data['idhogar'] == household, 'Target'] = correctPovertyClass
		
		# Ensure households with inconsistent poverty classes don't exist
		contradictoryhouseholds = data.groupby('idhogar')['Target'].apply(lambda x: x.nunique() == 1)
		contradictoryhouseholds = contradictoryhouseholds[contradictoryhouseholds != True]
		#print("\nAfter Correction: Number of households with inconsistent poverty classes: "+str(contradictoryhouseholds.count())+"")
		
		return data


	# In[8]:


	# **************************************************************************************
	# Nested functions: Reduce the numbers columns with some ordinal representations

	def create_ordinal_features(data):
		
		#------------------------------ Create ordinal variables for "wall condition"

		def wall_condition (row):
			if row['epared1'] == 1:
				return '1'
			if row['epared2'] == 1:
				return '2'
			if row['epared3'] == 1:
				return '3'
			return '0'

		data['wall_condition'] = data.apply (lambda row: wall_condition(row), axis=1)

		del data['epared1']
		del data['epared2']
		del data['epared3']

		#------------------------------ Create ordinal variables for "roof condition"

		def roof_condition (row):
			if row['etecho1'] == 1 :
				return '1'
			if row['etecho2'] == 1 :
				return '2'
			if row['etecho3'] == 1:
				return '3'
			return '0'

		data['roof_condition'] = data.apply (lambda row: roof_condition(row), axis=1)

		del data['etecho1']
		del data['etecho2']
		del data['etecho3']

		#------------------------------ Create ordinal variables for "floor condition"

		def floor_condition (row):
			if row['eviv1'] == 1 :
				return '1'
			if row['eviv2'] == 1 :
				return '2'
			if row['eviv3'] == 1:
				return '3'
			return '0'

		data['floor_condition'] = data.apply (lambda row: floor_condition(row), axis=1)

		del data['eviv1']
		del data['eviv2']
		del data['eviv3']

		#------------------------------ Create ordinal variables for "Education Achieved"

		def education_achieved (row):
			if row['instlevel1'] == 1 :
				return '1'
			if row['instlevel2'] == 1 :
				return '2'
			if row['instlevel3'] == 1:
				return '3'
			if row['instlevel4'] == 1 :
				return '4'
			if row['instlevel5'] == 1 :
				return '5'
			if row['instlevel6'] == 1:
				return '6'
			if row['instlevel7'] == 1 :
				return '7'
			if row['instlevel8'] == 1:
				return '8'
			if row['instlevel9'] == 1:
				return '9'
			return '0'

		data['education_achieved'] = data.apply (lambda row: education_achieved(row), axis=1)

		del data['instlevel1']
		del data['instlevel2']
		del data['instlevel3']
		del data['instlevel4']
		del data['instlevel5']
		del data['instlevel6']
		del data['instlevel7']
		del data['instlevel8']
		del data['instlevel9']
		
		data['wall_condition'] = data['wall_condition'].astype(np.float64)
		data['roof_condition'] = data['roof_condition'].astype(np.float64)
		data['floor_condition'] = data['floor_condition'].astype(np.float64)
		data['education_achieved'] = data['education_achieved'].astype(np.float64)
		
		return data

	# **************************************************************************************


	# In[9]:


	def drop_one_value_columns(data):
		
		# Drop columns with only 1 unique value.
		for column in data.columns:
			if len(data[column].unique()) == 1:
				#print(traindata[column].name)
				data.drop(column,inplace=True,axis=1)
				
		return data


	# In[10]:


	def drop_highly_correlated_features(data):
		
		# Drop columns with over 80% correlation
		threshold = 0.80
		corr_matrix = data.corr()
		upper = corr_matrix.where(np.triu(np.ones(corr_matrix.shape), k=1).astype(np.bool))
		to_drop = [column for column in upper.columns if any(abs(upper[column]) > threshold)]
		data = data.drop(columns = to_drop)
		
		return data


	# In[11]:


	def prepare_inputs_and_outputs(data):
		
		# Prepare & save the inputs and outputs features
		features = data.drop(['Target','Id','idhogar'], axis = 1)
		labels = data['Target']
		
		features.to_csv('train_features.csv')
		labels.to_csv('train_labels.csv')
		
		return features, labels


	# In[12]:


	def standard_scale(features):
		
		# Feature Scaling: Standardization
		cols = features.columns
		sc = StandardScaler()
		features = sc.fit_transform(features)
		features = pd.DataFrame(features, columns=cols)
		
		return features , sc


	# In[13]:


	def minmax_normalize(features):
		
		min_max_scaler = preprocessing.MinMaxScaler()
		cols = features.columns
		features_np_array = features.values # returns a numpy array
		features = min_max_scaler.fit_transform(features_np_array)
		features = pd.DataFrame(features, columns=cols)
		
		return features


	# In[14]:


	def randomUndersample(features, labels):

		undersample = RandomUnderSampler(sampling_strategy='majority') # define undersample strategy
		features, labels = undersample.fit_resample(features, labels) # fit and apply the transform
		
		return features, labels


	# In[15]:


	def selectkbestfeatures(features, labels):
		
		# Apply SelectKBest class to extract top 10 best features
		bestfeatures = SelectKBest(score_func=f_classif, k=25)
		bestfeatures.fit(features, labels)
		# Get columns to keep and create new dataframe with those only
		cols = bestfeatures.get_support(indices=True)
		features = features.iloc[:,cols]
		
		features.to_csv('train_features.csv')
		labels.to_csv('train_labels.csv')

		return features


	# In[16]:


	def split_data(features, labels):
		
		# Data Splitting: 60% for training, 20% for validation and 20% for testing.
		X_train, X_test, Y_train, y_test = train_test_split(features, labels, test_size=0.4)
		X_validation, X_test, Y_validation, y_test = train_test_split(X_test, y_test, test_size=0.5)
		
		return X_train, Y_train, X_test, y_test, X_validation, Y_validation


	# In[17]:


	def select_and_fit_model(train_inputs, train_outputs, selection):
		
		if str(selection) == '1':
			#print("Random Forest")
			algorithm = RandomForestClassifier()
			parameters = {
				'n_estimators': [20, 30, 40, 50],
				'max_depth': [5, 10, 20, 25, 30, 35, 40, 45, 50]
			}
			
		elif str(selection) == '2':
			#print("Logistic Regression")
			algorithm = LogisticRegression()
			parameters = {
				'C': [0.001, 0.01, 0.1, 1, 10, 100, 1000]
			}
			
		elif str(selection) == '3':
			#print("Multi Layer Perceptron")
			algorithm = MLPClassifier()
			parameters = {
				'hidden_layer_sizes': [(10,), (50,), (100,)],
				'activation': ['relu', 'tanh', 'logistic'],
				'learning_rate': ['constant', 'invscaling', 'adaptive']
			}
			
		elif str(selection) == '4':
			#print("Support Vector Machines")
			algorithm = SVC()
			parameters = {
				'kernel': ['linear', 'rbf'],
				'C': [0.1, 1, 10]
			}
			
		elif str(selection) == '5':
			#print("Gradient Boosting")
			algorithm = GradientBoostingClassifier()
			parameters = {
				'n_estimators': [5, 50, 250, 500],
				'max_depth': [1, 3, 5, 7, 9],
				'learning_rate': [0.01, 0.1, 1, 10, 100]
			}
				
		else:
			#print("Random Forest")
			algorithm = RandomForestClassifier()
			parameters = {
				'n_estimators': [20, 30, 40, 50],
				'max_depth': [5, 10, 20, 25, 30, 35, 40, 45, 50]
			}

		cv = GridSearchCV(algorithm, parameters, cv=5)
		cv.fit(train_inputs, train_outputs.values.ravel())
		
		return cv


	# In[18]:


	def evaluate_model(name, model, features, labels):
		
		start = time()
		pred = model.predict(features)
		end = time()
		
		print(str(round(accuracy_score(labels, pred), 2) * 100))
		#print(name+" Precision - "+str(round(precision_score(labels, pred, average='micro'), 9) * 100)+"%")
		#print(name+" Recall - "+str(round(recall_score(labels, pred, average='micro'), 9) * 100)+"%")
		#print(name+" Latency - "+str(round((end - start) * 1000, 1))+"ms \n")


	# In[19]:


	def request_inputs():
		
		# 1. Request the dataset
		#dataset = input("Enter Your Dataset Name: ")
		dataset = sys.argv[1]

		# 2. Request an algorithm
		#print("\nEnter 1 for Random Forest")
		#print("Enter 2 for Logistic Regression")
		#print("Enter 3 for Multi Layer Perceptron")
		#print("Enter 4 for Support Vector Machine")
		#print("Enter 5 for Gradient Boosting")
		#number = input("\nSelect an algorithm from the menu options given: ")
		number = sys.argv[2]
		
		return dataset, number


	# In[20]:


	def save_model(model, scaler):
		
		model_name = sys.argv[3]+".pkl"
		joblib.dump([model.best_estimator_, scaler], model_name)
		#print("\nModel Saved!")
		
	# In[21]:


	# 2. Get user inputs
	dataset_name, algorithm_number = request_inputs()

	# 3. Load the Dataset
	traindata = load_dataset(dataset_name)

	# 4. Handle the Missing Data
	missing_value_data = get_missing_data_percentage(traindata)
	traindata = drop_high_missing_data_columns(missing_value_data, traindata)
	missing_value_data = get_missing_data_percentage(traindata)
	traindata = impute_low_missing_data_columns(missing_value_data,  traindata)

	# 5. Correct any inconsistencies in the data
	traindata = correct_mixed_value_columns(traindata)
	traindata = correct_inconsistent_households(traindata)

	# 6. Feature Extraction & Selection
	traindata = create_ordinal_features(traindata)
	traindata = drop_one_value_columns(traindata)
	traindata = drop_highly_correlated_features(traindata)

	# 7. Feature & Label Separation
	train_features, train_labels = prepare_inputs_and_outputs(traindata)

	# 8. Feature Selection (1)
	train_features = selectkbestfeatures(train_features, train_labels)

	# 9. Data Splitting
	X_train, Y_train, X_test, y_test, X_validation, Y_validation = split_data(train_features, train_labels)

	# 10. Feature Scaling (1)
	scaler = StandardScaler()
	X_train = scaler.fit_transform(X_train)
	X_validation = scaler.transform(X_validation)
	X_test = scaler.transform(X_test)
	#train_features = minmax_normalize(train_features)

	# 11. Model Fitting
	cv_model = select_and_fit_model(X_train, Y_train, algorithm_number)

	# 12. Model Evaluation
	#evaluate_model('Train Set', cv_model, X_train, Y_train)
	#evaluate_model('Validation Set', cv_model, X_validation, Y_validation)
	evaluate_model('Test Set', cv_model, X_test, y_test)

	# 13. Save Model
	save_model(cv_model, scaler)
	
except Exception:

	print("Error found - "+str(traceback.format_exc()))