import re

def is_username_valid(username):
    check_username = re.search("[\d@_!#$%^&*()<>?/\|}{~:A-Z]",username)
    if (len(username)>=5 and len(username)<=9 and check_username):
        # print('username minimal terdapat 5-9 karakter tidak boleh menggunakan huruf kapital, angka dan spesial karakter')
        return False
    else:
        return True
        
def is_password_valid(password):
    check_password = re.search("[\d@_!#$%^&*()<>?/\|}{~:A-Z]", password)
    if (len(password)>=8 and check_password):
        return True
    else:
        # print('Password minimal terdapat 8 karakter dan harus memiliki setidaknya 1 digit angka, 1 huruf kapital dan 1 spesial karakter')
        return False

username = input("Username : ")
password = input("Password : ")
print(is_username_valid(username))
print(is_password_valid(password))