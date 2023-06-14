CREATE DATABASE uasdesainweb;

CREATE TABLE siswa (
NIK INT(16) NOT NULL PRIMARY KEY,
NISN INT(10) NOT NULL UNIQUE,
nama VARCHAR(50),
tempat_lahir VARCHAR(50)
tanggal_lahir DATE
jenis_kelamin ENUM('Laki-Laki' , 'Perempuan')
alamat TEXT,
ayah INT(16)FOREIGN KEY REFERENCES orangtua(NIK),
ibu INT(16)FOREIGN KEY REFERENCES orangtua(NIK),
gambar TEXT,
);

CREATE TABLE orangtua(
NIK INT(16) NOT NULL PRIMARY KEY,
nama VARCHAR(50)
);