import os
import sys

if os.path.exists(sys.argv[1]):
  index = os.remove(sys.argv[1])
else:
  print("The file does not exist")