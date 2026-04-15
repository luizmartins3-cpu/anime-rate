import requests
import time
import json
import urllib.parse

animes = [
    "One Piece", "Attack on Titan", "Death Note", "Demon Slayer", "Jujutsu Kaisen",
    "Solo Leveling", "Chainsaw Man", "Blue Lock", "Tokyo Revengers", "Spy x Family",
    "Your Name", "Horimiya", "Re:Zero", "Sword Art Online", "Bleach",
    "Dragon Ball Z", "Vinland Saga", "Fullmetal Alchemist: Brotherhood", "Hunter x Hunter",
    "Cyberpunk: Edgerunners", "Steins;Gate", "Haikyuu!!", "My Hero Academia",
    "One Punch Man", "Mob Psycho 100", "Kaguya-sama: Love is War", "Code Geass",
    "Cowboy Bebop", "Neon Genesis Evangelion"
]

results = []

for name in animes:
    try:
        encoded_name = urllib.parse.quote(name)
        url = f"https://kitsu.io/api/edge/anime?filter[text]={encoded_name}&page[limit]=1"
        response = requests.get(url)
        if response.status_code == 200:
            data = response.json()
            if data['data']:
                # Prefer large image
                image_url = data['data'][0]['attributes']['posterImage']['large']
                results.append({"name": name, "image": image_url})
            else:
                results.append({"name": name, "image": "NOT_FOUND"})
        else:
            results.append({"name": name, "image": f"ERROR_{response.status_code}"})
        
        # Small delay to be polite
        time.sleep(0.2)
    except Exception as e:
        results.append({"name": name, "image": f"EXCEPTION_{str(e)}"})

print(json.dumps(results, indent=2))
