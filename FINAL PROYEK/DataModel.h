#ifndef DATAMODEL_H
#define DATAMODEL_H

#include <string>
using namespace std;

// Struktur untuk data KTP pengguna
struct KTP {
    string NIK;
    string Nama;
    string TempatLahir;
    string TanggalLahir;
    string JenisKelamin;
    string Alamat;
    string Agama;
    string StatusPerkawinan;
    string Pekerjaan;
    string Kewarganegaraan;
};

// Struktur untuk data produk
struct Produk {
    int ID;
    string Kategori;
    string Nama;
    string Gender;
    int Stok;
    double Harga;
    double HargaBeli; // Untuk perhitungan profit
};

// Struktur untuk ukuran produk
struct Ukuran {
    string nama;       // S, M, L, XL, XXL
    double hargaTambahan;
};

// Node untuk Doubly Linked List
struct NodeDLL {
    Produk data;
    NodeDLL* prev;
    NodeDLL* next;
};

// Node untuk AVL Tree
struct NodeAVL {
    int ID;
    Produk* produkPtr;
    NodeAVL* left;
    NodeAVL* right;
    int height;
};

// Node untuk Huffman Tree
struct NodeHuffman {
    char karakter;
    int frekuensi;
    NodeHuffman* left;
    NodeHuffman* right;
};

// Node untuk Stack (Pembatalan)
struct NodeStack {
    int idProduk;
    int jumlah;
    string namaPembeli;
    string ukuran;
    NodeStack* next;
};

// Node untuk Queue (Antrian Kasir)
struct NodeQueue {
    string namaPembeli;
    Produk* produk;
    int jumlah;
    string ukuran;
    double totalHarga;
    NodeQueue* next;
};

// Struktur untuk transaksi penjualan
struct Transaksi {
    string namaPembeli;
    int idProduk;
    string namaProduk;
    string ukuran;
    int jumlah;
    double totalHarga;
    double profit;
    string timestamp;
};

#endif
