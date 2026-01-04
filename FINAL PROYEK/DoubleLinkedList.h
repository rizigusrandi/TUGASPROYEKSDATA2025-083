#ifndef DOUBLELINKEDLIST_H
#define DOUBLELINKEDLIST_H

#include "DataModel.h"
#include <iostream>
#include <iomanip>
#include <string>

using namespace std;

class DoublyLinkedList {
private:
    NodeDLL* head;
    NodeDLL* tail;
    int size;

public:
    DoublyLinkedList() : head(NULL), tail(NULL), size(0) {}
    
    // Menambah produk di akhir list
    void tambahProduk(Produk p) {
        NodeDLL* newNode = new NodeDLL;
        newNode->data = p;
        newNode->next = NULL;
        newNode->prev = tail;
        
        if (tail != NULL) {
            tail->next = newNode;
        } else {
            head = newNode;
        }
        tail = newNode;
        size++;
    }
    
    // Mencari produk berdasarkan ID
    Produk* cariProduk(int id) {
        NodeDLL* temp = head;
        while (temp != NULL) {
            if (temp->data.ID == id) {
                return &(temp->data);
            }
            temp = temp->next;
        }
        return NULL;
    }
    
    // Menampilkan semua produk
    void tampilkanSemua() {
        NodeDLL* temp = head;
        int no = 1;
        cout << "\n+---------------------------------------------------------------------+\n";
        cout << "| No |  ID  | Nama Produk            | Gender    | Stok  | Harga      |\n";
        cout << "|----+------+------------------------+-----------+-------+------------|\n";
        
        while (temp != NULL) {
            cout << "| " << left << setw(2) << no++ << " | ";
            cout << setw(4) << temp->data.ID << " | ";
            cout << setw(22) << temp->data.Nama.substr(0, 22) << " | ";
            cout << setw(9) << temp->data.Gender << " | ";
            cout << setw(5) << temp->data.Stok << " | Rp ";
            cout << setw(8) << fixed << setprecision(0) << temp->data.Harga << " |\n";
            temp = temp->next;
        }
        cout << "+---------------------------------------------------------------------+\n";
    }
    
    // Menampilkan produk berdasarkan kategori
    void tampilkanKategori(string kategori) {
        NodeDLL* temp = head;
        int no = 1;
        bool found = false;
        
        cout << "\n+---------------------------------------------------------------------+\n";
        cout << "| No |  ID  | Nama Produk            | Gender    | Stok  | Harga      |\n";
        cout << "|----+------+------------------------+-----------+-------+------------|\n";
        
        while (temp != NULL) {
            if (temp->data.Kategori == kategori) {
                found = true;
                cout << "| " << left << setw(2) << no++ << " | ";
                cout << setw(4) << temp->data.ID << " | ";
                cout << setw(22) << temp->data.Nama.substr(0, 22) << " | ";
                cout << setw(9) << temp->data.Gender << " | ";
                cout << setw(5) << temp->data.Stok << " | Rp ";
                cout << setw(8) << fixed << setprecision(0) << temp->data.Harga << " |\n";
            }
            temp = temp->next;
        }
        
        if (!found) {
            cout << "|                    Tidak ada produk dalam kategori ini                |\n";
        }
        cout << "+---------------------------------------------------------------------+\n";
    }
    
    // Update stok produk
    bool updateStok(int id, int jumlah) {
        Produk* p = cariProduk(id);
        if (p != NULL && p->Stok >= jumlah) {
            p->Stok -= jumlah;
            return true;
        }
        return false;
    }
    
    // Kembalikan stok (untuk pembatalan)
    bool kembalikanStok(int id, int jumlah) {
        Produk* p = cariProduk(id);
        if (p != NULL) {
            p->Stok += jumlah;
            return true;
        }
        return false;
    }
    
    NodeDLL* getHead() { return head; }
    int getSize() { return size; }
    
    ~DoublyLinkedList() {
        NodeDLL* temp;
        while (head != NULL) {
            temp = head;
            head = head->next;
            delete temp;
        }
    }
};

// Fungsi untuk inisialisasi 160 produk
void initProduk(DoublyLinkedList& katalog) {
    int id = 1001;
    
    // BAJU PRIA (20 item)
    string bajuPria[] = {"Kaos Polos Hitam", "Kemeja Formal Putih", "Polo Shirt Navy", "T-Shirt Grafis", 
                         "Kemeja Batik Slim", "Kaos V-Neck Abu", "Flannel Kotak", "Sweater Rajut", 
                         "Hoodie Zipper", "Kaos Oversize", "Kemeja Denim", "Raglan Baseball", 
                         "Kaos Henley", "Kemeja Linen", "Jersey Sport", "Tanktop Gym", 
                         "Kaos Stripe", "Kemeja Oxford", "Cardigan Knit", "Vest Rompi"};
    
    for (int i = 0; i < 20; i++) {
        Produk p;
        p.ID = id++;
        p.Kategori = "Baju";
        p.Nama = bajuPria[i];
        p.Gender = "Pria";
        p.Stok = 50 + (i % 10);
        p.Harga = 75000.0 + (i * 5000);
        p.HargaBeli = 45000.0 + (i * 3000);
        katalog.tambahProduk(p);
    }
    
    // BAJU WANITA (20 item)
    string bajuWanita[] = {"Blouse Satin", "Tunik Casual", "Atasan Brokat", "Kaos Crop Top", 
                           "Kemeja Floral", "Top Sabrina", "Blazer Wanita", "Cardigan Panjang", 
                           "Tank Top Spandex", "Sweater Turtleneck", "Blouse Renda", "Tunik Batik", 
                           "Kaos Loose Fit", "Kemeja Kotak", "Top Kutung", "Atasan Tie Dye", 
                           "Blouse Chiffon", "Vest Outer", "Crop Hoodie", "Tunik Polos"};
    
    for (int i = 0; i < 20; i++) {
        Produk p;
        p.ID = id++;
        p.Kategori = "Baju";
        p.Nama = bajuWanita[i];
        p.Gender = "Wanita";
        p.Stok = 45 + (i % 10);
        p.Harga = 85000.0 + (i * 5000);
        p.HargaBeli = 50000.0 + (i * 3000);
        katalog.tambahProduk(p);
    }
    
    // CELANA PRIA (20 item)
    string celanaPria[] = {"Jeans Slim Fit", "Chino Beige", "Cargo Hitam", "Jogger Pants", 
                           "Jeans Ripped", "Celana Formal", "Cargo Army", "Training Pants", 
                           "Short Jeans", "Chino Navy", "Celana Kargo", "Jogger Stripe", 
                           "Jeans Straight", "Celana Bahan", "Short Cargo", "Training Sport", 
                           "Jeans Washed", "Chino Khaki", "Jogger Cotton", "Celana Pendek"};
    
    for (int i = 0; i < 20; i++) {
        Produk p;
        p.ID = id++;
        p.Kategori = "Celana";
        p.Nama = celanaPria[i];
        p.Gender = "Pria";
        p.Stok = 40 + (i % 8);
        p.Harga = 150000.0 + (i * 10000);
        p.HargaBeli = 90000.0 + (i * 6000);
        katalog.tambahProduk(p);
    }
    
    // CELANA WANITA (20 item)
    string celanaWanita[] = {"Jeans Skinny", "Kulot Hitam", "Legging Spandex", "Palazzo Pants", 
                             "Jeans High Waist", "Celana Kulot", "Jogger Wanita", "Short Jeans", 
                             "Celana Plisket", "Wide Leg Pants", "Jeans Boyfriend", "Kulot Motif", 
                             "Legging Gym", "Hot Pants", "Celana Cargo", "Jogger Polos", 
                             "Jeans Mom", "Kulot Lipit", "Training Pants", "Short Kulot"};
    
    for (int i = 0; i < 20; i++) {
        Produk p;
        p.ID = id++;
        p.Kategori = "Celana";
        p.Nama = celanaWanita[i];
        p.Gender = "Wanita";
        p.Stok = 38 + (i % 8);
        p.Harga = 160000.0 + (i * 10000);
        p.HargaBeli = 95000.0 + (i * 6000);
        katalog.tambahProduk(p);
    }
    
    // JAKET PRIA (20 item)
    string jaketPria[] = {"Bomber Jacket", "Hoodie Jacket", "Varsity Jacket", "Denim Jacket", 
                          "Parka Tebal", "Windbreaker", "Leather Jacket", "Track Jacket", 
                          "Fleece Jacket", "Coach Jacket", "MA-1 Bomber", "Sweater Jacket", 
                          "Softshell Jacket", "Rain Jacket", "Harrington Jacket", "Sherpa Jacket", 
                          "Trucker Jacket", "Anorak Jacket", "Puffer Jacket", "Military Jacket"};
    
    for (int i = 0; i < 20; i++) {
        Produk p;
        p.ID = id++;
        p.Kategori = "Jaket";
        p.Nama = jaketPria[i];
        p.Gender = "Pria";
        p.Stok = 30 + (i % 6);
        p.Harga = 250000.0 + (i * 15000);
        p.HargaBeli = 150000.0 + (i * 9000);
        katalog.tambahProduk(p);
    }
    
    // JAKET WANITA (20 item)
    string jaketWanita[] = {"Cardigan Tebal", "Blazer Formal", "Parka Wanita", "Denim Jacket", 
                            "Bomber Satin", "Hoodie Zip", "Crop Jacket", "Leather Jacket", 
                            "Kimono Outer", "Long Cardigan", "Teddy Jacket", "Varsity Wanita", 
                            "Trench Coat", "Windbreaker", "Knit Jacket", "Puffer Jacket", 
                            "Duster Coat", "Rain Coat", "Sweater Jacket", "Biker Jacket"};
    
    for (int i = 0; i < 20; i++) {
        Produk p;
        p.ID = id++;
        p.Kategori = "Jaket";
        p.Nama = jaketWanita[i];
        p.Gender = "Wanita";
        p.Stok = 28 + (i % 6);
        p.Harga = 270000.0 + (i * 15000);
        p.HargaBeli = 160000.0 + (i * 9000);
        katalog.tambahProduk(p);
    }
    
    // SEPATU PRIA (20 item)
    string sepatuPria[] = {"Sneakers Canvas", "Loafers Kulit", "Boots Chelsea", "Running Shoes", 
                           "Oxford Formal", "High Top", "Slip On", "Boat Shoes", 
                           "Derby Shoes", "Sneakers Sport", "Monk Strap", "Espadrilles", 
                           "Driving Shoes", "Brogues", "Basketball Shoes", "Sandal Kulit", 
                           "Casual Sneakers", "Work Boots", "Tennis Shoes", "Moccasins"};
    
    for (int i = 0; i < 20; i++) {
        Produk p;
        p.ID = id++;
        p.Kategori = "Sepatu";
        p.Nama = sepatuPria[i];
        p.Gender = "Pria";
        p.Stok = 25 + (i % 5);
        p.Harga = 350000.0 + (i * 20000);
        p.HargaBeli = 210000.0 + (i * 12000);
        katalog.tambahProduk(p);
    }
    
    // SEPATU WANITA (20 item)
    string sepatuWanita[] = {"High Heels", "Flat Shoes", "Wedges", "Sneakers Wanita", 
                             "Sandal Heels", "Ballet Flats", "Platform Shoes", "Ankle Boots", 
                             "Mary Jane", "Mules", "Slingback", "Pumps", 
                             "Slip On Canvas", "Espadrille Wedges", "Gladiator Sandal", "Loafers", 
                             "Chelsea Boots", "Kitten Heels", "Sport Shoes", "Sandal Flat"};
    
    for (int i = 0; i < 20; i++) {
        Produk p;
        p.ID = id++;
        p.Kategori = "Sepatu";
        p.Nama = sepatuWanita[i];
        p.Gender = "Wanita";
        p.Stok = 22 + (i % 5);
        p.Harga = 380000.0 + (i * 20000);
        p.HargaBeli = 228000.0 + (i * 12000);
        katalog.tambahProduk(p);
    }
}

#endif
