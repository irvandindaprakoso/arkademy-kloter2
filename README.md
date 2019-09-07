# arkademy-kloter2
Test Online

------------------------------------------------------------------------------
### Untuk Soal test nomor 1,2,3,5 Saya menggunakan bahasa pemrograman Python 3
------------------------------------------------------------------------------

**Langkah untuk mengerjakan soal Nomor 6:**
1. Membuat database sesuai ketentuan dari soal, dalam kasus ini saya memberi nama arkademy_db
2. Tambahkan table __name__ , __work__ dan __category__
3. Membuat template html. saya menggunakan bootstrap 4 agar tampilannya lebih menarik dan lebih cepat dalam pembuatannya
4. Mengkoneksikan database dengan web yang telah dibuat dengan cara seperti dibawah ini :
```
  try {
      //get database name from file
      $mysql_hostname = "localhost";  //alamat server
      $mysql_user = "root";       	//username untuk koneksi ke database
      $mysql_password = "";   //password koneksi ke database
      $mysql_database = "arkademy_db";   //nama database yang akan diakses	
      // buat koneksi dengan database
      $pdo = new PDO("mysql:charset=utf8mb4;host=$mysql_hostname; dbname=$mysql_database", "$mysql_user", "$mysql_password");
      $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	    }
  catch (PDOException $e) {
      print "Connection problem : " . $e->getMessage() . "<br/>";
      die();
	}
```
5. Membuat class yang berisi fungsi-fungsi dari web yang akan dibuat (**CRUD**)
'''

class Arkademy{
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }
    public function view (){
        $result  = $this->pdo->query("SELECT n.id, n.name, w.name as work, c.salary FROM name n, work w, category c WHERE n.id_work=w.id AND n.id_salary=c.id");
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
    }
    public function selectWork (){
        $result  = $this->pdo->query("SELECT * FROM work");
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
    }
    public function selectCategory (){
        $result  = $this->pdo->query("SELECT * FROM category");
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
    }
    public function add($name, $work, $salary) {
        $result = $this->pdo->prepare("INSERT INTO name (
            name,
            id_work,
            id_salary)
            VALUES(
            :name,
            :id_work,
            :id_salary)");        
        $result->bindParam(':name',$name);
        $result->bindParam(':id_work',$work);
        $result->bindParam(':id_salary',$salary);
        $result->execute();
    }
    public function edit ($id){
        $result = $this->pdo->query("SELECT * FROM name WHERE id='$id'");
        $rows = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function delete($id) {
        $result = $this->pdo->prepare("DELETE FROM name WHERE id = ?");
        $result->bindParam(1, $id);
        $result->execute();
    }
    public function update($name, $work, $salary, $id) {
        $result = $this->pdo->prepare("UPDATE name SET  
            name      =:name, 
            id_work   =:id_work,
            id_salary =:id_salary
            WHERE id  =:id"); 
        $result->bindParam(':name', $name);
        $result->bindParam(':id_work', $work);
        $result->bindParam(':id_salary', $salary);
        $result->bindParam(':id', $id);
        
        if($result->execute()){
            return true;
        } else {return false;}
    }
    
}
'''

6. langkah selanjutnya tinggal memanggil fungsi yang telah dibuat tadi, contoh:
'''
    require "database.php";
    require "Arkademy-class.php";
    $class_arkademy     = new Arkademy($pdo);
    $view               = $class_arkademy->view();
    
    foreach($view as $data):
          <tr>
              <td><?=$data->name ?></td>
              <td><?=$data->work ?></td>
              <td><?=$data->salary?></td>
          </tr>
    endforeach
'''
7. lakukan hal yang sama untuk menambah, menghapus dan mengubah data
8. Berikut screenshot hasil akhir pembuatan web
![Screenshot View Data](https://github.com/irvandindaprakoso/arkademy/blob/master/view_data.png)
![Screenshot Tambah Data](https://github.com/irvandindaprakoso/arkademy/blob/master/tambah_data.png)
![Screenshot Hasil Tambah Data](https://github.com/irvandindaprakoso/arkademy/blob/master/hasil_tambah_data.png)
![Screenshot Edit Data](https://github.com/irvandindaprakoso/arkademy/blob/master/edit_data.png)
![Screenshot Hasil Edit Data](https://github.com/irvandindaprakoso/arkademy/blob/master/hasil_edit_data.png)
![Screenshot Hapus Data](https://github.com/irvandindaprakoso/arkademy/blob/master/hapus_data.png)
![Screenshot Hasil Hapus Data](https://github.com/irvandindaprakoso/arkademy/blob/master/hasil_hapus_data.png)



