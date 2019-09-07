def printTriangle(inp, res):
    if (inp % 2!=0):
        for row in range(inp):
            for col in range(inp+2):
                if (row==0) or (row==col and row<(inp//2)+2) or (row+col == inp+1 and row<(inp//2)+2):
                    print(res, end='')
                else:
                    print(" ", end='')
            print()
    else:
        print('Silahkan masukkan angka ganjil')
    return ''

inp = int(input("Masukkan Jumlah Baris : "))
res = "*"
print(printTriangle(inp,res))