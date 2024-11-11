<?php
include("admin_header.php");
include("admin_topnav.php");
include("admin_sidenav.php");

// Database connection

// Fetch data from motorparts_tbl
$query = "SELECT * FROM motorparts_tbl";
$result = mysqli_query($connection, $query);
?>

<style>
  .card img {
      height: 200px;
      object-fit: cover;
      width: 100%;
  }
  .section-heading {
      font-weight: bold;
      margin-top: 20px;
  }
  .form-card {
      background-color: #f8f9fa;
      border: 1px solid #ddd;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      padding: 20px;
      margin-top: 10px;
  }
</style>

<body>
<main id="main" class="main">
<div class="pagetitle">
  <h1>Motor Parts</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Components</li>
      <li class="breadcrumb-item active">Motor Parts</li>
    </ol>
  </nav>
</div>

<section class="section">
  <div class="row align-items-top">

      <!-- Selected Parts and Customer Details Form Section -->
      <div class="col-lg-3">
      <div class="form-card">
        <h3>Selected Parts</h3>
        <table class="table" id="selectedPartsTable">
          <thead>
            <tr>
              <th>Part Name</th>
              <th>Price</th>
              <th>Qty</th>
              <th>Total</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>

        <h3 class="mt-4">Customer Details</h3>
        <form id="orderForm" action="process_code/process_order.php" method="POST">
          <div class="form-group mb-2">
            <label for="customerName">Name</label>
            <input type="text" id="customerName" name="customerName" class="form-control" required>
          </div>
          <div class="form-group mb-2">
            <label for="customerContact">Contact Number</label>
            <input type="text" id="customerContact" name="customerContact" class="form-control" required>
          </div>
          <div class="form-group mb-3">
            <label for="customerAddress">Address</label>
            <textarea id="customerAddress" name="customerAddress" class="form-control" rows="2" required></textarea>
          </div>

          <input type="hidden" id="selectedParts" name="selectedParts">
          <button type="submit" class="btn btn-success w-100" id="orderButton">Place Order</button>
        </form>
      </div>
    </div>

    
    <!-- Display Motor Parts in Card Layout -->
    <div class="col-lg-9">
      <h3 class="section-heading">Available Motor Parts</h3>
      <div class="row">
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
          <div class="col-lg-4 mb-4">
            <div class="card">
              <img src="process_code/<?= $row['image_path']; ?>" class="card-img-top" alt="<?= $row['parts_name']; ?>">
              <div class="card-body">
                <h5 class="card-title"><?= $row['parts_name']; ?></h5>
                <p class="card-text"><?= $row['parts_number']; ?></p>
                <p class="card-text"><strong>Price: </strong>₱<?= number_format($row['price'], 2); ?></p>
                <label for="quantity">Quantity:</label>
                <input type="number" name="quantity" id="quantity-<?= $row['m_id']; ?>" min="1" max="<?= $row['QuantityInStock']; ?>" value="1" class="form-control mb-2">
                <button class="btn btn-primary add-to-cart-btn w-100" 
                        data-id="<?= $row['m_id']; ?>" 
                        data-name="<?= $row['parts_name']; ?>" 
                        data-price="<?= $row['price']; ?>" 
                        data-stock="<?= $row['QuantityInStock']; ?>">
                  Add to Cart
                </button>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>


  </div>
</section>
</main>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const cartTable = document.getElementById('selectedPartsTable').getElementsByTagName('tbody')[0];
    const selectedPartsInput = document.getElementById('selectedParts');
    const selectedParts = [];

    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
      button.addEventListener('click', function() {
        const partId = this.getAttribute('data-id');
        const partName = this.getAttribute('data-name');
        const partPrice = parseFloat(this.getAttribute('data-price')).toFixed(2);
        const stock = parseInt(this.getAttribute('data-stock'));
        const quantity = parseInt(document.getElementById('quantity-' + partId).value);

        if (quantity > stock) {
          alert("Quantity exceeds available stock.");
          return;
        }

        const total = (quantity * partPrice).toFixed(2);

        if (!document.getElementById('cart-item-' + partId)) {
          selectedParts.push({ id: partId, name: partName, price: partPrice, quantity: quantity });
          
          const row = cartTable.insertRow();
          row.id = 'cart-item-' + partId;
          row.insertCell(0).textContent = partName;
          row.insertCell(1).textContent = '₱' + partPrice;
          row.insertCell(2).textContent = quantity;
          row.insertCell(3).textContent = '₱' + total;
          const actionCell = row.insertCell(4);
          const removeButton = document.createElement('button');
          removeButton.classList.add('btn', 'btn-danger', 'btn-sm');
          removeButton.textContent = 'Remove';
          removeButton.addEventListener('click', function() {
            cartTable.removeChild(row);
            selectedParts.splice(selectedParts.findIndex(item => item.id === partId), 1);
          });
          actionCell.appendChild(removeButton);
        } else {
          alert('This part is already added to the cart.');
        }
      });
    });

    document.getElementById('orderForm').addEventListener('submit', function(event) {
      selectedPartsInput.value = JSON.stringify(selectedParts);
      if (selectedParts.length === 0) {
        event.preventDefault();
        alert("Please add at least one part to the cart before placing an order.");
      }
    });
  });
</script>
</body>
