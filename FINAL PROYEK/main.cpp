#include <iostream>
#include <iomanip>
#include <string>
#include <fstream>
#include <cmath>
#include <cstdlib>
#include "Menu.h"

using namespace std;

// Tampilan splash screen
void splashScreen() {
    system("cls");
    cout << "\n\n";
    cout << "     +----------------------------------------------------------------------------+\n";
    cout << "     |                                                                            |\n";
    cout << "     |  ||||||+  ||+        |||||||+ |||||||||  ||| |||  |||  ||+  ||| |||||||||  |\n";
    cout << "     |  ||+---+  |||        ||+--||| +--|||--+  ||| |||  |||  |||+ ||| |||        |\n";
    cout << "     |  |||      |||        |||  |||    |||     |||+|||  |||  ||||+||| ||| +----  |\n";
    cout << "     |  |||      |||        |||  |||    |||     ||| |||  |||  ||| |||| |||   |||  |\n";
    cout << "     |  ||||||+  ||||||||+  ||||||||    |||     ||| |||  |||  |||  ||| |||||||||  |\n";
    cout << "     |  +-----+  +-------+  +-----+     +-+     +-+ +-+  +-+  +-+  +-+ +-------+  |\n";
    cout << "     |                                                                            |\n";
    cout << "     |                ||||||+   ||||||+    |||||   ||+  |||  ||||||+              |\n";
    cout << "     |                ||+--||+  ||+--||+  ||+--||+ |||+ |||  ||+--||+             |\n";
    cout << "     |                ||||||+   ||||||+   |||||||| ||||+|||  |||  |||             |\n";
    cout << "     |                ||+--||+  ||+--||+  ||+--||| ||| ||||  |||  |||             |\n";
    cout << "     |                ||||||+   |||  |||  |||  ||| |||  |||  ||||||+              |\n";
    cout << "     |                +------+  +-+  +-+  +-+  +-+ +-+  +-+  +-----+              |\n";
    cout << "     |                                                                            |\n";
    cout << "     |                    MANAGEMENT SYSTEM WITH DATA STRUCTURES                  |\n";
    cout << "     |                                                                            |\n";
    cout << "     +----------------------------------------------------------------------------+\n\n";
	cout << "                       		Loading sistem";
   
    for (int i = 0; i < 5; i++) {
        cout << ".";
        cout.flush();
        // Simple delay tanpa sleep (untuk compatibility)
        for (long j = 0; j < 100000000; j++);
    }
    
    cout << " SELESAI!\n\n";
    cout << "                   	 Tekan Enter untuk melanjutkan...";
    cin.get();
}

// Menu utama
void menuUtama() {
    while (true) {
        system("cls");
        cout << "\n";
        cout << "     +--------------------------------------------------------------+\n";
        cout << "     |                                                              |\n";
        cout << "     |               CLOTHING BRAND MANAGEMENT SYSTEM               |\n";
        cout << "     |                                                              |\n";
        cout << "     |--------------------------------------------------------------|\n";
        cout << "     |                                                              |\n";
        cout << "     |     Struktur Data yang Digunakan:                            |\n";
        cout << "     |     * Doubly Linked List (160 Produk Katalog)                |\n";
        cout << "     |     * AVL Tree (Pencarian Produk by ID)                      |\n";
        cout << "     |     * Huffman Tree (Kompresi Data Struk)                     |\n";
        cout << "     |     * Stack (Sistem Pembatalan Order)                        |\n";
        cout << "     |     * Queue (Antrian Kasir)                                  |\n";
        cout << "     |     * Array Dinamis (Data KTP & Transaksi)                   |\n";
        cout << "     |                                                              |\n";
        cout << "     |--------------------------------------------------------------|\n";
        cout << "     |                                                              |\n";
        cout << "     |           [1] Login/Register                                 |\n";
        cout << "     |           [2] Mode Administrator                             |\n";
        cout << "     |           [0] Keluar dari Program                            |\n";
        cout << "     |                                                              |\n";
        cout << "     +--------------------------------------------------------------+\n\n";
        cout << "     Pilih mode akses: ";
        
        int pilihan;
        cin >> pilihan;
        
        switch (pilihan) {
            case 1:
               menuTransaksi();
                break;
            case 2:
                menuAdmin();
                break;
            case 0:
                system("cls");
                cout << "\n\n";
                cout << "     +-------------------------------------------------------------------+\n";
                cout << "     |                                                                   |\n";
                cout << "     |            Terima kasih telah menggunakan sistem kami!            |\n";
                cout << "     |                                                                   |\n";
                cout << "     |                 CLOTHING BRAND MANAGEMENT SYSTEM                  |\n";
                cout << "     |                        Developed with C++                         |\n";
                cout << "     |                                                                   |\n";
                cout << "     |           Struktur Data: DLL, AVL, Huffman, Stack, Queue          |\n";
                cout << "     |                                                                   |\n";
                cout << "     +-------------------------------------------------------------------+\n\n";
                cleanupSistem();
                return;
            default:
                cout << "\n     [!] Pilihan tidak valid. Tekan Enter untuk melanjutkan...";
                cin.ignore();
                cin.get();
        }
    }
}

// Fungsi main
int main() {
    // Inisialisasi sistem
    initSistem();
    
    // Tampilkan splash screen
    splashScreen();
    
    // Jalankan menu utama
    menuUtama();
    
    return 0;
}
