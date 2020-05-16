#!/usr/bin/python3
import os, requests, pprint, json, re, sys
import argparse

parser = argparse.ArgumentParser(description='Zenodo Tool')
parser.add_argument('--list', action='store_true', default=False, help='List all depositions and exit')
parser.add_argument('--upload', action='store_true', default=False, help='Upload changes')
parser.add_argument('--users', action='store_true', default=False, help='Modify deposition by replacing creators with 
pres=parser.parse_args(sys.argv[1:])

if "ZENODO_ACCESS" not in os.environ:
    print("You need a zenodo access token to use this tool.")
    exit(1)

access_token = os.environ["ZENODO_ACCESS"]

listdeps = pres.list
upload = pres.upload

print(listdeps,upload)
exit(0)

if listdeps:
  deps = requests.get("https://zenodo.org/api/deposit/depositions",params={"access_token":access_token})
  assert deps.status_code == 200
  for dep in deps.json():
      print("id:",dep['id'],dep['title'])
  exit(0)

id = "3522103"
dep = requests.get("https://zenodo.org/api/deposit/depositions/"+id,params={"access_token":access_token})
c = dep.json()

creators = {}
with open("developers.txt", "r") as fd:
    for line in fd.readlines():
        cols = line.strip().split(":")
        if cols[0] == "Name":
            continue
        creators[cols[0]] = cols

names = creators.keys()

release_team = {
  "Steven R. Brandt":1,
  "Maria Babiuc-Hamilton":1,
  "Peter Diener":1,
  "Matthew Elley":1,
  "Zachariah Etienne":1,
  "Giuseppe Ficarra":1,
  "Roland Haas":1,
  "Helvi Witek":1
}

def relkey(name):
    g = re.match(r'^(.+)\s+(\S+)$',name)
    if name in release_team.keys():
        return "A"+g.group(2)+", "+g.group(1)
    else:
        return "Z"+g.group(2)+", "+g.group(1)

for name in release_team.keys():
    assert name in names, name

names = sorted(names,key=relkey)

items = []
for name in names:
    cols = creators[name]
    affiliation = cols[2]
    item = {
        'name':re.sub(r'~',' ',name),
        'affiliation':cols[2]
    }
    if 3 < len(cols) and cols[3].strip() != '':
        orcid = cols[3].strip()
        assert re.match(r'^\d{4}(-[\dX]{4}){3}$',orcid), orcid
        item['orcid'] = orcid
    items += [item]

#c = {'metadata':{'creators':[]}}

c['metadata']['creators'] = items

with open("zupload.py","w") as fd:
    pp = pprint.PrettyPrinter(stream=fd)
    pp.pprint(c)

if upload:
    pp = pprint.PrettyPrinter()
    dep = requests.put("https://zenodo.org/api/deposit/depositions/"+id,
        data=json.dumps(c),
        headers={"Content-Type": "application/json"},
        params={"access_token":access_token})
    print(dep.status_code)
    pp.pprint(dep.json())