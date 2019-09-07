inp = input("Masukkan Kata : ")
print("Jumlah Huruf vokal : ", sum(map(inp.lower().count, 'aiueo')))