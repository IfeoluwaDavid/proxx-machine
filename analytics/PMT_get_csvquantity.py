import glob

csvfiles = []
for file in glob.glob("*.csv"):
    csvfiles.append(file)
print (len(csvfiles))