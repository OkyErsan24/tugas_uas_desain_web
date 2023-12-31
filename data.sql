CREATE TABLE orangtua(
NIK VARCHAR(16) NOT NULL PRIMARY KEY,
nama VARCHAR(50)
); 
CREATE TABLE siswa (
NIK VARCHAR(16) NOT NULL PRIMARY KEY,
NISN VARCHAR(10) NOT NULL UNIQUE,
nama VARCHAR(50),
tempat_lahir VARCHAR(50),
tanggal_lahir DATE,
jenis_kelamin ENUM('Laki-Laki' , 'Perempuan'),
alamat TEXT,
ayah VARCHAR(16),
ibu VARCHAR(16),
gambar TEXT,
FOREIGN KEY (ayah) REFERENCES orangtua(NIK) ON UPDATE CASCADE ON DELETE SET NULL,
FOREIGN KEY (ibu) REFERENCES orangtua(NIK) ON UPDATE CASCADE ON DELETE SET NULL
);

DROP TABLE siswa;
DROP TABLE orangtua;