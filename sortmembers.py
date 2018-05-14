#/usr/bin/python3
import re
members = {}
with open("members.txt","r") as fd:
    for line in fd.readlines():
        g = re.match('^\S.*\S',line)
        if g:
            key = g.group(0)
            if key not in members:
                members[key] = {}
        else:
            g = re.match('^ \S.*\S',line)
            if g:
                members[key][g.group(0)] = 1

def memkey(k):
    if k == 'Individuals without affiliation':
        return k
    g = re.match('https?:\S+\s+(?:The\s+|)(\S.*\S)',k)
    if not g:
        print('k=',k)
    return g.group(1)

def pkey(k):
    k = re.sub(r'https?:\S+\s+','',k)
    g = re.match(r'(.*)\b(\w.*)',k)
    return g.group(2)+' '+g.group(1)

univ = sorted(members.keys(), key=memkey)
for k in univ:
    people = sorted(members[k].keys(),key=pkey)
    print(k)
    for p in people:
        print(p)
    print()