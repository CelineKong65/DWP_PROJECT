<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Manage Page</title>
    <link rel="stylesheet" href="manage_product.css">
    <style>
    /* Modal styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.4);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 40%;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    .modal button {
        background-color: #B3C8CF;
        color: white;
        padding: 10px 20px;
        margin-top: 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .modal button:hover {
        background-color: #98B0B9;
    }

    #addProductBtn {
        background-color: #98B0B9;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        margin: 20px auto;
        display: block;
    }

    #addProductBtn:hover {
        background-color: #0056b3;
    }

    input[type="text"],input[type="file"] {
        width: 590px;
        height: 40px;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }
    </style>
</head>
<body>
    <header>
        <a id="back" href="../Admin_home.html"><b>BACK TO ADMIN PAGE</b></a>
        <div class="container">
            <h1>OKAY STATIONERY SHOP</h1>
            
        </div>
    </header>
    <h2>Manage Product</h2>
    <button id="addProductBtn">Add Product</button>
        <div id="productModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Add Product</h2>
                <form action="#" method="post">
                    <label for="product_id"><b>Product ID:</b></label>
                    <input type="text" id="product_id" name="product_id" required>

                    <label for="product_name"><b>Product Name:</b></label>
                    <input type="text" id="product_name" name="product_name" required>

                    <label for="product_price"><b>Product Price:</b></label>
                    <input type="text" id="product_price" name="product_price" required>

                    <label for="product_quantity"><b>Product Quantity:</b></label>
                    <input type="text" id="product_quantity" name="product_quantity" required>

                    <label for="product_image"><b>Product Image:</b></label>
                    <input type="file" id="product_image" name="product_image" accept="image/*" required>

                    <button type="submit" name="add_product">Add Product</button>
                </form>
            </div>
        </div>

    <main>

        <div class="Product">
            <img src="stapler_staples.png" alt="Stapler and Staples">
            <h2>Stapler and Staples</h2>
            <p class="product_price">RM2.99</p>
            <p>Product ID: 001</p>
            <div class="product_quantity">
                <button>-</button>
                <span>30</span>
                <button>+</button>
            </div>
            <div class="buttons">
                <button class="delete">Delete</button>
            </div>
        </div>

        <div class="Product">
            <img src="binder_lever_arch_file.png" alt="Binder Lever Arch File">
            <h2>Binder Lever Arch File</h2>
            <p class="product_price">RM5.60</p>
            <p>Product_ID: 002</p>
            <div class="product_quantity">
                <button>-</button>
                <span>10</span>
                <button>+</button>
            </div>
            <div class="buttons">
                <button class="delete">Delete</button>
            </div>
        </div>

        <div class="Product">
            <img src="pen.png" alt="Pen">
            <h2>MAG Pen</h2>
            <p></p>
            <p class="product_price">RM6.00</p>
            <p>Product_ID: 003</p>
            <div class="product_quantity">
                <button>-</button>
                <span>12</span>
                <button>+</button>
            </div>
            <div class="buttons">
                <button class="delete">Delete</button>
            </div>
        </div>

        <div class="Product">
            <img src="pencil.png" alt="Pencil">
            <h2>Pencil 2B-12 Pcs</h2>
            <p class="product_price">RM6.00</p>
            <p>Product_ID: 004</p>
            <div class="product_quantity">
                <button>-</button>
                <span>10</span>
                <button>+</button>
            </div>
            <div class="buttons">
                <button class="delete">Delete</button>
            </div>
        </div>

        <div class="Product">
            <img src="painting_marker.png" alt="Painting Marker">
            <h2>Painting Marker</h2>
            <p class="product_price">RM15.00</p>
            <p>Product_ID: 005</p>
            <div class="product_quantity">
                <button>-</button>
                <span>50</span>
                <button>+</button>
            </div>
            <div class="buttons">
                <button class="delete">Delete</button>
            </div>
        </div>

        <div class="Product">
            <img src="crayon.png" alt="Crayon">
            <h2>Crayon</h2>
            <p class="product_price">RM30.00</p>
            <p>Product_ID: 006</p>
            <div class="product_quantity">
                <button>-</button>
                <span>8</span>
                <button>+</button>
            </div>
            <div class="buttons">
                <button class="delete">Delete</button>
            </div>
        </div>

        <div class="Product">
            <img src="adhesive_tape.png" alt="Adhesive Tape">
            <h2>Adhesive Tape</h2>
            <p class="product_price">RM3.00</p>
            <p>Product_ID: 007</p>
            <div class="product_quantity">
                <button>-</button>
                <span>17</span>
                <button>+</button>
            </div>
            <div class="buttons">
                <button class="delete">Delete</button>
            </div>
        </div>

        <div class="Product">
            <img src="watercolor_paint.png" alt="Watercolor Paint">
            <h2>Watercolor Paint</h2>
            <p class="product_price">RM14.00</p>
            <p>Product_ID: 008</p>
            <div class="product_quantity">
                <button>-</button>
                <span>22</span>
                <button>+</button>
            </div>
            <div class="buttons">
                <button class="delete">Delete</button>
            </div>
        </div>
        <div class="Product">
            <img src="eraser.png" alt="Eraser">
            <h2>Eraser</h2>
            <p class="product_price">RM5.00</p>
            <p>Product_ID: 009</p>
            <div class="product_quantity">
                <button>-</button>
                <span>20</span>
                <button>+</button>
            </div>
            <div class="buttons">
                <button class="delete">Delete</button>
            </div>
        </div>

        <div class="Product">
            <img src="scissors.png" alt="Scissors">
            <h2>Scissors</h2>
            <p class="product_price">RM5.70</p>
            <p>Product_ID: 010</p>
            <div class="product_quantity">
                <button>-</button>
                <span>19</span>
                <button>+</button>
            </div>
            <div class="buttons">
                <button class="delete">Delete</button>
            </div>
        </div>
    
    </main>

    <!-- Previous and Next Buttons -->
    <div class="PNbutton">
        <button id="prevBtn">&#9664;</button> <!-- Previous symbol -->
        <button id="nextBtn">&#9654;</button> <!-- Next symbol -->
    </div>

    <script>
    var productModal = document.getElementById("productModal");
    var productBtn = document.getElementById("addProductBtn");
    var span = document.getElementsByClassName("close")[0];

    productBtn.onclick = function() {
        productModal.style.display = "block";
    }

    span.onclick = function() {
        productModal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == productModal) {
            productModal.style.display = "none";
        }
    }
</script>
    


</body>
</html>