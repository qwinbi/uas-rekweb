@extends('layouts.admin')

@section('title', 'QRIS Settings')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h4 class="fw-bold mb-4" style="color: var(--burgundy);">
                    <i class="fas fa-qrcode me-2"></i>QRIS Settings
                </h4>
                
                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <!-- QRIS Status -->
                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="qris_enabled" id="qrisEnabled" checked>
                            <label class="form-check-label fw-semibold" for="qrisEnabled" style="color: var(--lapis-lazuli);">
                                Enable QRIS Payment
                            </label>
                        </div>
                        <small class="text-muted">Enable or disable QRIS as a payment option</small>
                    </div>
                    
                    <!-- QRIS Details -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3" style="color: var(--lapis-lazuli);">QRIS Details</h6>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Merchant Name</label>
                                <input type="text" class="form-control" name="merchant_name" 
                                       value="BUNNYPOPS" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Merchant City</label>
                                <input type="text" class="form-control" name="merchant_city" 
                                       value="JAKARTA" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Merchant ID</label>
                                <input type="text" class="form-control" name="merchant_id" 
                                       placeholder="ID1234567890" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Transaction Fee (%)</label>
                                <input type="number" class="form-control" name="transaction_fee" 
                                       value="0.7" step="0.01" min="0" max="5">
                                <small class="text-muted">Percentage fee charged per transaction</small>
                            </div>
                        </div>
                    </div>
                    
                    <!-- QR Code Image -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3" style="color: var(--lapis-lazuli);">QR Code Image</h6>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="border rounded p-4 text-center">
                                    <div id="qrisPreview" class="mb-3">
                                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=BUNNYPOPS-ID1234567890" 
                                             class="img-fluid" style="max-width: 200px;">
                                    </div>
                                    <input type="file" class="form-control" name="qris_image" 
                                           accept="image/*" onchange="previewQrisImage(this)">
                                    <small class="text-muted d-block mt-2">Upload custom QRIS image (PNG, 500x500px)</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="border rounded p-3">
                                    <h6 class="fw-bold mb-3">QR Code Generator</h6>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">QR Code Data</label>
                                        <textarea class="form-control" id="qrisData" rows="3">BUNNYPOPS-ID1234567890</textarea>
                                        <small class="text-muted">Data encoded in QR code</small>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Size</label>
                                        <select class="form-select" id="qrSize">
                                            <option value="200">200x200</option>
                                            <option value="300" selected>300x300</option>
                                            <option value="400">400x400</option>
                                            <option value="500">500x500</option>
                                        </select>
                                    </div>
                                    
                                    <button type="button" class="btn btn-outline-primary w-100" onclick="generateQRCode()">
                                        <i class="fas fa-qrcode me-2"></i>Generate QR Code
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Payment Banks -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3" style="color: var(--lapis-lazuli);">Supported Banks</h6>
                        
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead style="background: var(--light-blue);">
                                    <tr>
                                        <th>Bank Name</th>
                                        <th>Status</th>
                                        <th>Minimum Amount</th>
                                        <th>Maximum Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="banksTable">
                                    @foreach([
                                        ['name' => 'BCA', 'status' => true, 'min' => 10000, 'max' => 10000000],
                                        ['name' => 'Mandiri', 'status' => true, 'min' => 10000, 'max' => 10000000],
                                        ['name' => 'BNI', 'status' => true, 'min' => 10000, 'max' => 5000000],
                                        ['name' => 'BRI', 'status' => true, 'min' => 10000, 'max' => 10000000]
                                    ] as $index => $bank)
                                    <tr>
                                        <td>
                                            <input type="text" class="form-control form-control-sm" 
                                                   name="banks[{{ $index }}][name]" value="{{ $bank['name'] }}">
                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" 
                                                       name="banks[{{ $index }}][status]" {{ $bank['status'] ? 'checked' : '' }}>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm" 
                                                   name="banks[{{ $index }}][min_amount]" value="{{ $bank['min'] }}">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm" 
                                                   name="banks[{{ $index }}][max_amount]" value="{{ $bank['max'] }}">
                                        </td>
                                        <td>
                                            @if($index > 0)
                                            <button type="button" class="btn btn-sm btn-danger" onclick="removeBank(this)">
                                                <i class="fas fa-times"></i>
                                            </button>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <button type="button" class="btn btn-outline-primary btn-sm" onclick="addBank()">
                            <i class="fas fa-plus me-2"></i>Add Bank
                        </button>
                    </div>
                    
                    <!-- QRIS Settings -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3" style="color: var(--lapis-lazuli);">Payment Settings</h6>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Payment Expiry Time (minutes)</label>
                                <input type="number" class="form-control" name="expiry_time" 
                                       value="30" min="1" max="1440">
                                <small class="text-muted">Time before payment expires</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Auto Check Interval (seconds)</label>
                                <input type="number" class="form-control" name="check_interval" 
                                       value="10" min="5" max="60">
                                <small class="text-muted">Interval for checking payment status</small>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check form-switch mt-4">
                                    <input class="form-check-input" type="checkbox" name="auto_capture" id="autoCapture" checked>
                                    <label class="form-check-label" for="autoCapture">
                                        Auto Capture Payment
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check form-switch mt-4">
                                    <input class="form-check-input" type="checkbox" name="send_notification" id="sendNotification" checked>
                                    <label class="form-check-label" for="sendNotification">
                                        Send Payment Notifications
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Instructions -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3" style="color: var(--lapis-lazuli);">Payment Instructions</h6>
                        
                        <div class="mb-3">
                            <label class="form-label">Instructions for Customers</label>
                            <textarea class="form-control" name="instructions" rows="4">1. Open your mobile banking app
2. Tap on QRIS/QR Code Scanner
3. Scan the QR code displayed
4. Enter the payment amount
5. Confirm the transaction
6. Wait for payment confirmation</textarea>
                        </div>
                    </div>
                    
                    <!-- Submit -->
                    <div class="d-flex justify-content-end gap-3">
                        <button type="reset" class="btn btn-outline-secondary">
                            <i class="fas fa-redo me-2"></i>Reset
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Save QRIS Settings
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Preview Sidebar -->
    <div class="col-lg-4">
        <!-- Live Preview -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <h6 class="fw-bold mb-3" style="color: var(--burgundy);">Checkout Preview</h6>
                
                <div class="checkout-preview rounded-3 p-4" style="background: var(--light-pink);">
                    
                    <div class="text-center mb-4">
                        <h6 class="fw-bold mb-3" style="color: var(--lapis-lazuli);">Pay with QRIS</h6>
                        <div class="mb-3">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=BUNNYPOPS-ID1234567890" 
                                 class="img-fluid rounded border" style="max-width: 200px;" id="qrisLivePreview">
                        </div>
                        <p class="small mb-2" style="color: var(--lapis-lazuli);">
                            <strong>Merchant:</strong> <span id="merchantNamePreview">BUNNYPOPS</span>
                        </p>
                        <p class="small mb-3" style="color: var(--lapis-lazuli);">
                            <strong>Amount:</strong> Rp 499,000
                        </p>
                    </div>
                    
                    <div class="payment-instructions mb-4">
                        <h6 class="fw-bold mb-2" style="color: var(--lapis-lazuli);">How to Pay:</h6>
                        <div class="small" style="color: var(--lapis-lazuli);" id="instructionsPreview">
                            1. Open your mobile banking app<br>
                            2. Tap on QRIS/QR Code Scanner<br>
                            3. Scan the QR code displayed
                        </div>
                    </div>
                    
                    <div class="supported-banks">
                        <h6 class="fw-bold mb-2" style="color: var(--lapis-lazuli);">Supported Banks:</h6>
                        <div class="d-flex flex-wrap gap-2" id="banksPreview">
                            @foreach(['BCA', 'Mandiri', 'BNI', 'BRI'] as $bank)
                            <span class="badge" style="background: var(--light-blue); color: var(--lapis-lazuli);">
                                {{ $bank }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- QRIS Statistics -->
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="fw-bold mb-3" style="color: var(--burgundy);">QRIS Statistics</h6>
                
                <div class="list-group list-group-flush">
                    <div class="list-group-item border-0 px-0 d-flex justify-content-between">
                        <span>Total Transactions</span>
                        <span class="fw-semibold">1,248</span>
                    </div>
                    <div class="list-group-item border-0 px-0 d-flex justify-content-between">
                        <span>Success Rate</span>
                        <span class="fw-semibold text-success">98.5%</span>
                    </div>
                    <div class="list-group-item border-0 px-0 d-flex justify-content-between">
                        <span>Average Amount</span>
                        <span class="fw-semibold">Rp 356,000</span>
                    </div>
                    <div class="list-group-item border-0 px-0 d-flex justify-content-between">
                        <span>Today's Transactions</span>
                        <span class="fw-semibold">42</span>
                    </div>
                </div>
                
                <div class="mt-4">
                    <button class="btn btn-outline-primary w-100" onclick="testQRIS()">
                        <i class="fas fa-test-tube me-2"></i>Test QRIS Payment
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let bankCount = 4;
    
    function previewQrisImage(input) {
        const file = input.files[0];
        
        if (file) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                document.getElementById('qrisPreview').innerHTML = 
                    `<img src="${e.target.result}" class="img-fluid" style="max-width: 200px;">`;
                document.getElementById('qrisLivePreview').src = e.target.result;
            }
            
            reader.readAsDataURL(file);
        }
    }
    
    function generateQRCode() {
        const data = document.getElementById('qrisData').value;
        const size = document.getElementById('qrSize').value;
        
        if (data) {
            const qrUrl = `https://api.qrserver.com/v1/create-qr-code/?size=${size}x${size}&data=${encodeURIComponent(data)}`;
            
            document.getElementById('qrisPreview').innerHTML = 
                `<img src="${qrUrl}" class="img-fluid" style="max-width: 200px;">`;
            document.getElementById('qrisLivePreview').src = qrUrl;
            
            Swal.fire({
                title: 'QR Code Generated!',
                text: 'New QR code has been generated successfully.',
                icon: 'success',
                timer: 1500,
                showConfirmButton: false,
                background: 'var(--light-pink)',
                color: 'var(--burgundy)'
            });
        }
    }
    
    function addBank() {
        const table = document.getElementById('banksTable');
        const row = table.insertRow();
        row.innerHTML = `
            <td>
                <input type="text" class="form-control form-control-sm" 
                       name="banks[${bankCount}][name]" placeholder="Bank Name">
            </td>
            <td>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" 
                           name="banks[${bankCount}][status]" checked>
                </div>
            </td>
            <td>
                <input type="number" class="form-control form-control-sm" 
                       name="banks[${bankCount}][min_amount]" value="10000">
            </td>
            <td>
                <input type="number" class="form-control form-control-sm" 
                       name="banks[${bankCount}][max_amount]" value="10000000">
            </td>
            <td>
                <button type="button" class="btn btn-sm btn-danger" onclick="removeBank(this)">
                    <i class="fas fa-times"></i>
                </button>
            </td>
        `;
        bankCount++;
        updateBanksPreview();
    }
    
    function removeBank(button) {
        button.closest('tr').remove();
        updateBanksPreview();
    }
    
    function testQRIS() {
        Swal.fire({
            title: 'Test QRIS Payment',
            html: `
                <div class="text-center mb-3">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=TEST-BUNNYPOPS-${Date.now()}" 
                         class="img-fluid mb-3">
                    <p class="small text-muted">Scan this test QR code</p>
                </div>
                <div class="mb-3">
                    <label class="form-label">Test Amount</label>
                    <input type="number" class="form-control" id="testAmount" value="100000">
                </div>
            `,
            showCancelButton: true,
            confirmButtonText: 'Simulate Payment',
            confirmButtonColor: 'var(--burgundy)',
            cancelButtonColor: 'var(--silver-lake)',
            background: 'var(--light-pink)',
            color: 'var(--burgundy)',
            preConfirm: () => {
                const amount = document.getElementById('testAmount').value;
                if (!amount) {
                    Swal.showValidationMessage('Please enter test amount');
                }
                return { amount: amount };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Simulate payment processing
                Swal.fire({
                    title: 'Processing...',
                    text: 'Simulating QRIS payment',
                    timer: 2000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    background: 'var(--light-pink)',
                    color: 'var(--burgundy)'
                }).then(() => {
                    Swal.fire({
                        title: 'Payment Successful!',
                        text: `Test payment of Rp ${result.value.amount.toLocaleString()} completed.`,
                        icon: 'success',
                        confirmButtonColor: 'var(--burgundy)',
                        background: 'var(--light-pink)',
                        color: 'var(--burgundy)'
                    });
                });
            }
        });
    }
    
    function updateBanksPreview() {
        const banksPreview = document.getElementById('banksPreview');
        const bankInputs = document.querySelectorAll('input[name*="[name]"]');
        
        banksPreview.innerHTML = '';
        bankInputs.forEach(input => {
            if (input.value) {
                const badge = document.createElement('span');
                badge.className = 'badge';
                badge.style.background = 'var(--light-blue)';
                badge.style.color = 'var(--lapis-lazuli)';
                badge.textContent = input.value;
                banksPreview.appendChild(badge);
            }
        });
    }
    
    function updatePreview() {
        document.getElementById('merchantNamePreview').textContent = 
            document.querySelector('input[name="merchant_name"]').value;
        document.getElementById('instructionsPreview').innerHTML = 
            document.querySelector('textarea[name="instructions"]').value.replace(/\n/g, '<br>');
        updateBanksPreview();
    }
    
    // Live updates
    document.querySelectorAll('input, textarea').forEach(input => {
        input.addEventListener('input', updatePreview);
    });
    
    // Initial preview update
    updatePreview();
</script>

<style>
    .form-switch .form-check-input {
        width: 3em;
        height: 1.5em;
    }
    
    .form-switch .form-check-input:checked {
        background-color: var(--burgundy);
        border-color: var(--burgundy);
    }
    
    .table-bordered {
        border-color: var(--cherry-blossom);
    }
    
    .table-bordered th,
    .table-bordered td {
        border-color: var(--cherry-blossom);
    }
    
    .table thead th {
        background-color: rgba(242, 174, 188, 0.1);
    }
    
    .checkout-preview {
        border: 2px solid var(--cherry-blossom);
    }
    
    .badge {
        padding: 0.25em 0.75em;
        border-radius: 10px;
    }
</style>
@endsection