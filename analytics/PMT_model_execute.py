#!/usr/bin/env python
# coding: utf-8

# In[6]:

import pandas as pd
import numpy as np
import joblib
import sys

import warnings
warnings.filterwarnings('ignore', category=FutureWarning)
warnings.filterwarnings('ignore', category=DeprecationWarning)

try:
    
    input_predictors = pd.read_csv("train_features.csv")
    input_predictors = input_predictors.drop([input_predictors.columns[0]], axis=1)

    model_name = sys.argv[1]
    model, scaler = joblib.load(model_name)
    #print(f"Put in all features, comma separated: {','.join(list(input_predictors.columns))}")
    features = sys.argv[2].replace(" ","").split(",")
    user_info_df = pd.DataFrame(data=[features], index = None, columns=input_predictors.columns)
    user_info_df = user_info_df.astype(np.float64)
    user_info_df = scaler.transform(user_info_df)
    povertyclass = model.predict(user_info_df)
    print(int(povertyclass[0]))

except IOError as e:

    print("Error: Unable to find the specified model!")