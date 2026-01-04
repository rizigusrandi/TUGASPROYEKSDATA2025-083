// assets/js/search.js - Fitur Pencarian Produk

// Initialize search functionality
document.addEventListener('DOMContentLoaded', function() {
    initializeSearch();
});

function initializeSearch() {
    const searchInput = document.getElementById('searchInput');
    const searchBtn = document.getElementById('searchBtn');
    
    if (!searchInput) return;
    
    // Search on button click
    if (searchBtn) {
        searchBtn.addEventListener('click', performSearch);
    }
    
    // Search on Enter key
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            performSearch();
        }
    });
    
    // Real-time search (optional)
    searchInput.addEventListener('input', function() {
        if (this.value.length > 0) {
            performSearch();
        } else {
            showAllProducts();
        }
    });
}

function performSearch() {
    const searchInput = document.getElementById('searchInput');
    const searchTerm = searchInput.value.toLowerCase().trim();
    
    if (searchTerm === '') {
        showAllProducts();
        return;
    }
    
    const allCards = document.querySelectorAll('.card');
    let foundCount = 0;
    
    allCards.forEach(card => {
        const productName = card.querySelector('h3').textContent.toLowerCase();
        const productPrice = card.querySelector('p').textContent.toLowerCase();
        
        if (productName.includes(searchTerm) || productPrice.includes(searchTerm)) {
            card.style.display = 'block';
            card.style.animation = 'fadeIn 0.3s ease-in';
            foundCount++;
        } else {
            card.style.display = 'none';
        }
    });
    
    // Show/hide sections based on results
    const sections = document.querySelectorAll('.products');
    sections.forEach(section => {
        const visibleCards = section.querySelectorAll('.card[style*="display: block"]');
        if (visibleCards.length === 0) {
            section.style.display = 'none';
        } else {
            section.style.display = 'block';
        }
    });
    
    // Show search results message
    showSearchResults(searchTerm, foundCount);
}

function showAllProducts() {
    const allCards = document.querySelectorAll('.card');
    const sections = document.querySelectorAll('.products');
    
    allCards.forEach(card => {
        card.style.display = 'block';
    });
    
    sections.forEach(section => {
        section.style.display = 'block';
    });
    
    // Remove search results message
    const resultsMsg = document.getElementById('searchResultsMsg');
    if (resultsMsg) {
        resultsMsg.remove();
    }
}

function showSearchResults(term, count) {
    // Remove existing message
    const existingMsg = document.getElementById('searchResultsMsg');
    if (existingMsg) {
        existingMsg.remove();
    }
    
    // Create new message
    const resultsMsg = document.createElement('div');
    resultsMsg.id = 'searchResultsMsg';
    resultsMsg.style.cssText = `
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 1.5rem;
        border-radius: 10px;
        margin: 2rem auto;
        max-width: 1200px;
        text-align: center;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        animation: slideDown 0.3s ease-out;
    `;
    
    if (count > 0) {
        resultsMsg.innerHTML = `
            <h3 style="margin: 0 0 0.5rem 0;">🔍 Hasil Pencarian: "${term}"</h3>
            <p style="margin: 0; opacity: 0.9;">Ditemukan ${count} produk yang cocok</p>
            <button onclick="clearSearch()" style="
                margin-top: 1rem;
                padding: 0.5rem 1.5rem;
                background: white;
                color: #667eea;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-weight: 500;
            ">✖ Clear Search</button>
        `;
    } else {
        resultsMsg.innerHTML = `
            <h3 style="margin: 0 0 0.5rem 0;">❌ Tidak Ditemukan</h3>
            <p style="margin: 0; opacity: 0.9;">Produk "${term}" tidak ditemukan</p>
            <button onclick="clearSearch()" style="
                margin-top: 1rem;
                padding: 0.5rem 1.5rem;
                background: white;
                color: #667eea;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-weight: 500;
            ">🔙 Lihat Semua Produk</button>
        `;
    }
    
    // Insert after hero section or at the beginning of content
    const hero = document.querySelector('.hero');
    if (hero && hero.nextSibling) {
        hero.parentNode.insertBefore(resultsMsg, hero.nextSibling);
    } else {
        const firstSection = document.querySelector('.products');
        if (firstSection) {
            firstSection.parentNode.insertBefore(resultsMsg, firstSection);
        }
    }
}

function clearSearch() {
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.value = '';
    }
    showAllProducts();
}

// Add animation CSS
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .search-container {
        max-width: 600px;
        margin: 2rem auto;
        padding: 0 1rem;
    }
    
    .search-box {
        display: flex;
        gap: 0.5rem;
        background: white;
        padding: 0.5rem;
        border-radius: 50px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    
    .search-box input {
        flex: 1;
        border: none;
        outline: none;
        padding: 0.8rem 1.5rem;
        font-size: 1rem;
        border-radius: 50px;
    }
    
    .search-box button {
        padding: 0.8rem 2rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 50px;
        cursor: pointer;
        font-weight: 500;
        transition: transform 0.2s;
    }
    
    .search-box button:hover {
        transform: scale(1.05);
    }
    
    .search-box button:active {
        transform: scale(0.95);
    }
`;
document.head.appendChild(style);