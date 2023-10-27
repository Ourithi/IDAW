import requests
import time
import json

url='http://localhost/IDAW/Projet/backend/repas.php'

for jour in range(1,31):
    for type_repas in range(1,5):
        for mois in range(7,11):
            time.sleep(0.5)
            date="2023-{}-{}".format(mois,jour)
            data="{{\r\n    \"id_user\":\"1\",\r\n    \"id_type\":\"{}\",\r\n    \"date\":\"{}\"\r\n}}".format(type_repas,date)
            request=requests.request("POST",url,data=data, headers={'Content-Type': 'text/plain'})
            print(data)
            print(f"Status Code: {request.status_code}, Content: {request.json()}")