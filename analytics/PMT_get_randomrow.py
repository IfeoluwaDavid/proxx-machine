#!/usr/bin/env python
# coding: utf-8

# In[1]:

import traceback
import sys

try:

    str = sys.argv[1]

    with open("train_features_and_labels.csv") as f:
        lines = f.readlines()

    print(lines[int(str)+1])
        
except Exception:

    print("Error found - "+str(traceback.format_exc()))

