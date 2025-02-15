<nav class="navbar navbar-expand-lg fixed-top" style="background-color: #1d8348; width: 100%;">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center text-white" href="#">
            <img src="Assets/icon/actscc_logo.png" width="50" height="50" class="d-inline-block align-top" alt="Logo"
                style="margin-right: 10px;">
            <span id="alumniText" class="ml-2"
                style="font-family: 'Arial', sans-serif; font-weight: bold; color: white; margin-left: 10px;">
                ACTS COMPUTER COLLEGE
            </span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link text-white" href="../caps/landingpage.php">HOME</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#">ABOUT</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#">ACADEMICS</a></li>
                <!-- <li class="nav-item"><a class="nav-link text-white" href="#">STUDENTS</a></li> -->
                <!-- <li class="nav-item"><a class="nav-link text-white" href="#">RESEARCH</a></li> -->
                <li class="nav-item"><a class="nav-link text-white" href="#">ALUMNI</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#">Profile</a></li>
            </ul>
        </div>
    </div>
</nav>


<div class="p-4 border rounded shadow-sm bg-white">
    <div class="block-heading text-center">
        <h2 class="text-info">Graduate Tracer Survey</h2>
    </div>

    <h3 class="mb-4">A. General Information</h3>

    <form action="http://localhost/Caps/validate/info.php" method="POST">

        <div class="form-group">
            <label>Student No.</label>
            <input type="text" name="student_number" value="<?= htmlspecialchars($_GET['student_number'] ?? '') ?>"
                required>
        </div>

        <div class="form-group row">
            <div class="col-md-4">
                <label>Last Name</label>
                <input type="text" name="last_name" value="<?= htmlspecialchars($_GET['last_name'] ?? '') ?>" required>
            </div>
            <div class="col-md-4">
                <label>First Name</label>
                <input type="text" name="first_name" value="<?= htmlspecialchars($_GET['first_name'] ?? '') ?>"
                    required>
            </div>
            <div class="col-md-4">
                <label>Middle Name</label>
                <input type="text" name="middle_name" value="<?= htmlspecialchars($_GET['middle_name'] ?? '') ?>">
            </div>
        </div>

        <!-- <h3>Contact Information</h3> -->
        <label for="address">Permanent Address:</label>
        <input type="text" id="address" name="address" required><br><br>

        <label for="mobile">Mobile No.:</label>
        <input type="text" id="mobile" name="mobile"><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($_GET['email'] ?? '') ?>"><br><br>

        <label for="civilstatus">Civil Status:</label>
        <select id="civilstatus" name="civilstatus" required>
            <option value="Single">Single</option>
            <option value="Married">Married</option>
        </select><br><br>

        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="M">Male</option>
            <option value="F">Female</option>
        </select><br><br>

        <!-- <h3>Location Details</h3> -->
        <form method="http://localhost/Caps/validate/info.php" action="submit_form.php" id="userForm">
            <label for="region">Region:</label>
<select id="region" name="region_id" required>
    <option value="">Select Region</option>
</select><br><br>

<label for="province">Province:</label>
<select id="province" name="province_id" required>
    <option value="">Select Province</option>
</select><br><br>

<label for="city">City:</label>
<select id="city" name="city_id" required>
    <option value="">Select City</option>
</select><br><br>

<label for="barangay">Barangay:</label>
<select id="barangay" name="barangay_id" required>
    <option value="">Select Barangay</option>
</select><br><br>


            <button type="submit">Submit</button>
        </form>
</div>
<!-- Your existing form and content above -->

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Your AJAX script -->
<script>
$(document).ready(function() {
    // Load regions on page load
    $.ajax({
        url: "view/places/get_regions.php", // Updated path
        type: "GET",
        success: function(data) {
            let regions = JSON.parse(data);
            $.each(regions, function(index, region) {
                $("#region").append(`<option value="${region.id}">${region.name}</option>`);
            });
        }
    });

    // Load provinces when a region is selected
    $("#region").change(function() {
        let regionId = $(this).val();
        $("#province").html('<option value="">Select Province</option>'); // Reset
        $("#city").html('<option value="">Select City</option>');
        $("#barangay").html('<option value="">Select Barangay</option>');

        $.ajax({
            url: "view/places/get_provinces.php", // Updated path
            type: "GET",
            data: { region_id: regionId },
            success: function(data) {
                let provinces = JSON.parse(data);
                $.each(provinces, function(index, province) {
                    $("#province").append(`<option value="${province.id}">${province.name}</option>`);
                });
            }
        });
    });

    // Load cities when a province is selected
    $("#province").change(function() {
        let provinceId = $(this).val();
        $("#city").html('<option value="">Select City</option>');
        $("#barangay").html('<option value="">Select Barangay</option>');

        $.ajax({
            url: "view/places/get_cities.php", // Updated path
            type: "GET",
            data: { province_id: provinceId },
            success: function(data) {
                let cities = JSON.parse(data);
                $.each(cities, function(index, city) {
                    $("#city").append(`<option value="${city.id}">${city.name}</option>`);
                });
            }
        });
    });

    // Load barangays when a city is selected
    $("#city").change(function() {
        let cityId = $(this).val();
        $("#barangay").html('<option value="">Select Barangay</option>');

        $.ajax({
            url: "view/places/get_barangays.php", // Updated path
            type: "GET",
            data: { city_id: cityId },
            success: function(data) {
                let barangays = JSON.parse(data);
                $.each(barangays, function(index, barangay) {
                    $("#barangay").append(`<option value="${barangay.id}">${barangay.name}</option>`);
                });
            }
        });
    });
});

