###################
REST API CRUD Employee
###################

**REST API CRUD Employee** dibangun menggunakan **CodeIgniter 3**.  
API ini digunakan sebagai backend untuk sistem frontend CRUD Employee.

*******************
🔁 Endpoint API
*******************
Method -> Endpoint           -> Keterangan
GET    ->  /api/employee     -> Ambil semua data 
GET    -> /api/employee/{id} -> Ambil data by ID 
POST   -> /api/employee      -> Tambah data      
PUT    -> /api/employee/{id} -> Update data      
DELETE -> /api/employee/{id} -> Hapus data       

**************************
Penjelasan REST API
**************************
API ini digunakan untuk melakukan operasi CRUD (Create, Read, Update, Delete) pada data. REST API dijalankan menggunakan Docker, sehingga server API berjalan di container dan dapat diakses melalui alamat: `<http://localhost:8080/index.php/api/employee>`_ REST API akan tersambung dengan database bernama **juke_employee** yang berisi tabel bernama **employees**

