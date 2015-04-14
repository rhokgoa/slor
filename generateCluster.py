#oggpnosn 
#hkhr

#generating cluster 

import sklearn as sk 
import numpy as np
import os 
from sklearn.cluster import KMeans
import json 

data = json.load(open("data.json"))

latlong = [(str(item["lat"]), str(item['lng'])) for item in data]
X = np.array([[item["lat"], item['lng']] for i in range(item["count"]) for item in data])

def interpretLabels(labels, places):
    clusters = [[] for label in set(labels)]
    for i in range(len(labels)):
        clusters[labels[i]].append(places[i])
    return clusters   


# X = np.load("distanceMatrixV2.npy")
# X = np.nan_to_num(X)

kmeans = KMeans(n_clusters=int(os.sys.argv[1]))

kmeans.fit(X)

locations = []
for i in range(int(os.sys.argv[1])):
	locations.append({"lat": kmeans.cluster_centers_[i][0], "lng": kmeans.cluster_centers_[i][1]})
print locations
# clusters = interpretLabels(kmeans.labels_, latlong) 


# parseData= []
# for cluster in clusters:
# 	parseData.append({"lat":cluster[0][0], "lng":cluster[0][1]})
# print parseData	


