import requests
import time
import json
import random

url='http://localhost/IDAW/Projet/backend/aliments_repas.php'

for id_repas in range(1,481):
    for nb_plats in range(2):

        time.sleep(0.1)
        id_aliment=random.randint(1,2095)
        quantite=random.randint(1,2)*100
        data="{{\r\n    \"id_repas\":\"{}\",\r\n    \"id_aliment\":\"{}\",\r\n    \"quantite\":\"{}\"\r\n}}".format(id_repas,id_aliment,quantite)
        request=requests.request("POST",url,data=data, headers={'Content-Type': 'text/plain'})
        #print(data)
        print(f"Status Code: {request.status_code}, Content: {request.json()}")