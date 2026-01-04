#ifndef TREES_H
#define TREES_H

#include "DataModel.h"
#include <iostream>
#include <cmath>
#include <string>
#include <iomanip>

// ============== AVL TREE untuk Search ID Produk ==============
class AVLTree {
private:
    NodeAVL* root;
    
    // Mendapatkan tinggi node
    int height(NodeAVL* node) {
        if (node == NULL) return 0;
        return node->height;
    }
    
    // Mendapatkan balance factor
    int getBalance(NodeAVL* node) {
        if (node == NULL) return 0;
        return height(node->left) - height(node->right);
    }
    
    // Rotasi kanan
    NodeAVL* rightRotate(NodeAVL* y) {
        NodeAVL* x = y->left;
        NodeAVL* T2 = x->right;
        
        x->right = y;
        y->left = T2;
        
        y->height = 1 + max(height(y->left), height(y->right));
        x->height = 1 + max(height(x->left), height(x->right));
        
        return x;
    }
    
    // Rotasi kiri
    NodeAVL* leftRotate(NodeAVL* x) {
        NodeAVL* y = x->right;
        NodeAVL* T2 = y->left;
        
        y->left = x;
        x->right = T2;
        
        x->height = 1 + max(height(x->left), height(x->right));
        y->height = 1 + max(height(y->left), height(y->right));
        
        return y;
    }
    
    // Insert node dengan balancing
    NodeAVL* insert(NodeAVL* node, int id, Produk* produk) {
        if (node == NULL) {
            NodeAVL* newNode = new NodeAVL;
            newNode->ID = id;
            newNode->produkPtr = produk;
            newNode->left = newNode->right = NULL;
            newNode->height = 1;
            return newNode;
        }
        
        if (id < node->ID)
            node->left = insert(node->left, id, produk);
        else if (id > node->ID)
            node->right = insert(node->right, id, produk);
        else
            return node;
        
        node->height = 1 + max(height(node->left), height(node->right));
        
        int balance = getBalance(node);
        
        // Left Left
        if (balance > 1 && id < node->left->ID)
            return rightRotate(node);
        
        // Right Right
        if (balance < -1 && id > node->right->ID)
            return leftRotate(node);
        
        // Left Right
        if (balance > 1 && id > node->left->ID) {
            node->left = leftRotate(node->left);
            return rightRotate(node);
        }
        
        // Right Left
        if (balance < -1 && id < node->right->ID) {
            node->right = rightRotate(node->right);
            return leftRotate(node);
        }
        
        return node;
    }
    
    // Search node
    Produk* search(NodeAVL* node, int id) {
        if (node == NULL) return NULL;
        if (id == node->ID) return node->produkPtr;
        if (id < node->ID) return search(node->left, id);
        return search(node->right, id);
    }

public:
    AVLTree() : root(NULL) {}
    
    void insert(int id, Produk* produk) {
        root = insert(root, id, produk);
    }
    
    Produk* search(int id) {
        return search(root, id);
    }
};

// ============== HUFFMAN TREE untuk Kompresi String ==============
class HuffmanTree {
private:
    NodeHuffman* root;
    
    // Struct untuk menyimpan kode huffman
    struct HuffmanCode {
        char karakter;
        string kode;
    };
    
    HuffmanCode* kodeArray;
    int kodeSize;
    
    // Menghitung frekuensi karakter
    void hitungFrekuensi(string teks, char*& chars, int*& freqs, int& size) {
        bool ada[256] = {false};
        int tempFreq[256] = {0};
        
        for (int i = 0; i < teks.length(); i++) {
            tempFreq[(unsigned char)teks[i]]++;
            ada[(unsigned char)teks[i]] = true;
        }
        
        size = 0;
        for (int i = 0; i < 256; i++) {
            if (ada[i]) size++;
        }
        
        chars = new char[size];
        freqs = new int[size];
        
        int idx = 0;
        for (int i = 0; i < 256; i++) {
            if (ada[i]) {
                chars[idx] = (char)i;
                freqs[idx] = tempFreq[i];
                idx++;
            }
        }
    }
    
    // Membuat Huffman Tree
    NodeHuffman* buatTree(char* chars, int* freqs, int size) {
        NodeHuffman** nodes = new NodeHuffman*[size];
        
        for (int i = 0; i < size; i++) {
            nodes[i] = new NodeHuffman;
            nodes[i]->karakter = chars[i];
            nodes[i]->frekuensi = freqs[i];
            nodes[i]->left = nodes[i]->right = NULL;
        }
        
        int activeSize = size;
        while (activeSize > 1) {
            // Cari dua node dengan frekuensi terkecil
            int min1 = 0, min2 = 1;
            if (nodes[min2]->frekuensi < nodes[min1]->frekuensi) {
                int temp = min1;
                min1 = min2;
                min2 = temp;
            }
            
            for (int i = 2; i < activeSize; i++) {
                if (nodes[i]->frekuensi < nodes[min1]->frekuensi) {
                    min2 = min1;
                    min1 = i;
                } else if (nodes[i]->frekuensi < nodes[min2]->frekuensi) {
                    min2 = i;
                }
            }
            
            // Buat node parent
            NodeHuffman* parent = new NodeHuffman;
            parent->karakter = '\0';
            parent->frekuensi = nodes[min1]->frekuensi + nodes[min2]->frekuensi;
            parent->left = nodes[min1];
            parent->right = nodes[min2];
            
            // Hapus dua node terkecil dan tambah parent
            int larger = (min1 > min2) ? min1 : min2;
            int smaller = (min1 < min2) ? min1 : min2;
            
            nodes[larger] = nodes[activeSize - 1];
            activeSize--;
            nodes[smaller] = parent;
        }
        
        NodeHuffman* result = nodes[0];
        delete[] nodes;
        return result;
    }
    
    // Generate kode huffman
    void generateKode(NodeHuffman* node, string kode) {
        if (node == NULL) return;
        
        if (node->left == NULL && node->right == NULL) {
            kodeArray[kodeSize].karakter = node->karakter;
            kodeArray[kodeSize].kode = kode.empty() ? "0" : kode;
            kodeSize++;
            return;
        }
        
        generateKode(node->left, kode + "0");
        generateKode(node->right, kode + "1");
    }
    
    // Encode string
    string encode(string teks) {
        string result = "";
        for (int i = 0; i < teks.length(); i++) {
            for (int j = 0; j < kodeSize; j++) {
                if (kodeArray[j].karakter == teks[i]) {
                    result += kodeArray[j].kode;
                    break;
                }
            }
        }
        return result;
    }

public:
    HuffmanTree() : root(NULL), kodeArray(NULL), kodeSize(0) {}
    
    // Kompresi string dan hitung efisiensi
    void kompresi(string teks, int& ukuranSebelum, int& ukuranSesudah, double& efisiensi) {
        if (teks.empty()) {
            ukuranSebelum = ukuranSesudah = 0;
            efisiensi = 0;
            return;
        }
        
        char* chars;
        int* freqs;
        int size;
        
        hitungFrekuensi(teks, chars, freqs, size);
        
        if (size == 1) {
            ukuranSebelum = teks.length() * 8;
            ukuranSesudah = teks.length();
            efisiensi = ((double)(ukuranSebelum - ukuranSesudah) / ukuranSebelum) * 100;
            delete[] chars;
            delete[] freqs;
            return;
        }
        
        root = buatTree(chars, freqs, size);
        
        kodeArray = new HuffmanCode[size];
        kodeSize = 0;
        generateKode(root, "");
        
        string encoded = encode(teks);
        
        ukuranSebelum = teks.length() * 8;
        ukuranSesudah = encoded.length();
        efisiensi = ((double)(ukuranSebelum - ukuranSesudah) / ukuranSebelum) * 100;
        
        delete[] chars;
        delete[] freqs;
    }
    
    void tampilkanTabel() {
        cout << "\n+---------------------------+\n";
        cout << "| Karakter | Kode Huffman   |\n";
        cout << "|----------+----------------|\n";
        for (int i = 0; i < kodeSize; i++) {
            cout << "|    " << kodeArray[i].karakter << "     | ";
            cout << left << setw(14) << kodeArray[i].kode << " |\n";
        }
        cout << "+---------------------------+\n";
    }
    
    ~HuffmanTree() {
        if (kodeArray != NULL) delete[] kodeArray;
    }
};

#endif
