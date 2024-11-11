<?php
include("admin_header.php");
include("admin_topnav.php");
include("admin_sidenav.php");


// Fetch data from motorparts_tbl
$query_parts = "SELECT * FROM motorparts_tbl";
$result_parts = mysqli_query($connection, $query_parts);

// Fetch data from services_tbl for car and motorcycle services
$query_services = "SELECT id, services_name, services_type, price, description FROM services_tbl WHERE services_type IN ('car', 'motorcycle')";
$result_services = mysqli_query($connection, $query_services);
?>

<style>
  .card img {
      height: 200px;
      object-fit: cover;
      width: 100%;
  }
  .left-aligned-section {
      max-width: 350px;
      width: 100%;
      margin-bottom: 20px;
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
  .form-card h3 {
      color: #333;
      font-weight: bold;
      margin-bottom: 15px;
  }
</style>

<body>
<main id="main" class="main">
<div class="pagetitle">
  <h1>Walk in Services</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Components</li>
      <li class="breadcrumb-item active">Walk in Services</li>
    </ol>
  </nav>
</div>

<section class="section">
  <div class="row align-items-top">
    
    <!-- Left-aligned Customer Details Form -->
    <div class="col-lg-3 left-aligned-section">
      <div class="form-card">
        
      <!-- Selected Items Table -->
      <h3 class="section-heading mt-4">Selected Items</h3>
      <table class="table" id="selectedPartsTable">
        <thead>
          <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>

        <h3>Customer Details</h3>
        <form id="orderForm" action="process_code/process_service_order.php" method="POST">
          <div class="form-group mb-3">
            <label for="customerName" class="form-label">Full Name</label>
            <input type="text" id="customerName" name="customerName" class="form-control" required placeholder="Enter your full name">
          </div>
          <div class="form-group mb-3">
            <label for="customerContact" class="form-label">Contact Number</label>
            <input type="tel" id="customerContact" name="customerContact" class="form-control" required placeholder="Enter your contact number" pattern="[0-9]{10,11}">
            <small class="form-text text-muted">Format: 10 or 11 digits</small>
          </div>
          <div class="form-group mb-3">
            <label for="customerAddress" class="form-label">Address</label>
            <textarea id="customerAddress" name="customerAddress" class="form-control" rows="2" required placeholder="Enter your address"></textarea>
          </div>

          <input type="hidden" id="selectedItems" name="selectedItems">
          <button type="submit" class="btn btn-success mt-3 w-100" id="orderButton">Place Order</button>
        </form>
      </div>
    </div>

    <!-- Services Section -->
    <div class="col-lg-9">
      <h3 class="section-heading">Available Services</h3>
      <div class="row">
        <?php while($service = mysqli_fetch_assoc($result_services)) { ?>
          <div class="col-lg-4 mb-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($service['services_name']); ?></h5>
                <p class="card-text"><strong>Type: </strong><?= ucfirst(htmlspecialchars($service['services_type'])); ?></p>
                <p class="card-text"><?= htmlspecialchars($service['description']); ?></p>
                <p class="card-text"><strong>Price: </strong>₱<?= number_format($service['price'], 2); ?></p>
                <button class="btn btn-primary add-to-cart-btn" 
                        data-id="service-<?= htmlspecialchars($service['id']); ?>" 
                        data-name="<?= htmlspecialchars($service['services_name']); ?>" 
                        data-price="<?= $service['price']; ?>">
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
    const selectedItemsInput = document.getElementById('selectedItems');
    const selectedItems = [];

    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
      button.addEventListener('click', function() {
        const itemId = this.getAttribute('data-id');
        const itemName = this.getAttribute('data-name');
        const itemPrice = parseFloat(this.getAttribute('data-price')).toFixed(2);

        if (!document.getElementById('cart-item-' + itemId)) {
          selectedItems.push({ id: itemId, name: itemName, price: itemPrice });
          
          const row = cartTable.insertRow();
          row.id = 'cart-item-' + itemId;
          row.insertCell(0).textContent = itemName;
          row.insertCell(1).textContent = '₱' + itemPrice;
          const actionCell = row.insertCell(2);
          const removeButton = document.createElement('button');
          removeButton.classList.add('btn', 'btn-danger', 'btn-sm');
          removeButton.textContent = 'Remove';
          removeButton.addEventListener('click', function() {
            cartTable.removeChild(row);
            selectedItems.splice(selectedItems.findIndex(item => item.id === itemId), 1);
          });
          actionCell.appendChild(removeButton);
        } else {
          alert('This item is already in the cart.');
        }
      });
    });

    document.getElementById('orderForm').addEventListener('submit', function(event) {
      selectedItemsInput.value = JSON.stringify(selectedItems);
      if (selectedItems.length === 0) {
        event.preventDefault();
        alert("Please add at least one item to the cart before placing an order.");
      }
    });
  });
</script>
</body>
