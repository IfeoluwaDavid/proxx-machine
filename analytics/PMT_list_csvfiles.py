import glob
import sys

csvfiles = []
for file in glob.glob("*.csv"):
    csvfiles.append(file)
print (csvfiles[int(sys.argv[1])])