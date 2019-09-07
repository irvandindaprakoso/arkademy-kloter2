inp = "993141 -1 1323 14-232"
inp_split = "".join(i for i in inp if i.isalnum())
# print(inp_split)
res = ''
for i in range(1,len(inp_split)+1):
    if i%3==0:
       res+= inp_split[i-3:i]+'-' 
print(res)
# STUCK