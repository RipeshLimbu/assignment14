<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Content Filtering</title>
    <style>
        .item { margin: 10px 0; }
    </style>
</head>
<body>
    <h1>Product List</h1>
    <label>
        Category:
        <select id="categoryFilter">
            <option value="">All</option>
            <option value="Electronics">Electronics</option>
            <option value="Clothing">Clothing</option>
        </select>
    </label>
    <label>
        Price Range:
        <select id="priceFilter">
            <option value="">All</option>
            <option value="0-50">0 - $50</option>
            <option value="51-100">$51 - $100</option>
        </select>
    </label>
    <div id="productList"></div>

    <script>
        const products = [
            { name: "Smartphone", category: "Electronics", price: 99 },
            { name: "T-shirt", category: "Clothing", price: 25 },
            { name: "Laptop", category: "Electronics", price: 500 },
            { name: "Jeans", category: "Clothing", price: 75 }
        ];

        const productList = document.getElementById("productList");
        const categoryFilter = document.getElementById("categoryFilter");
        const priceFilter = document.getElementById("priceFilter");

        function renderProducts(filterCategory = "", filterPrice = "") {
            productList.innerHTML = ""; // Clear existing items
            products
                .filter(product => {
                    const [minPrice, maxPrice] = filterPrice ? filterPrice.split("-").map(Number) : [0, Infinity];
                    return (!filterCategory || product.category === filterCategory) &&
                           (product.price >= minPrice && product.price <= maxPrice);
                })
                .forEach(product => {
                    const item = document.createElement("div");
                    item.classList.add("item");
                    item.textContent = `${product.name} - $${product.price}`;
                    productList.appendChild(item);
                });
        }

        // Initialize product list
        renderProducts();

        // Event listeners for filters
        categoryFilter.addEventListener("change", function () {
            renderProducts(categoryFilter.value, priceFilter.value);
        });

        priceFilter.addEventListener("change", function () {
            renderProducts(categoryFilter.value, priceFilter.value);
        });
    </script>
</body>
</html>
