function validateForm() {
    const shopName = document.getElementById("shop_name").value.trim();
    const ownerName = document.getElementById("owner_name").value.trim();
    const businessType = document.getElementById("business_type").value;
    const license = document.getElementById("license").value;
    const contact = document.getElementById("contact").value;

    document.getElementById("shop_name_error").innerHTML = "";
    document.getElementById("owner_name_error").innerHTML = "";
    document.getElementById("business_type_error").innerHTML = "";
    document.getElementById("license_error").innerHTML = "";
    document.getElementById("contact_error").innerHTML = "";

    let valid = true;

    if (shopName === "") {
        document.getElementById("shop_name_error").innerHTML = "Shop name is required.";
        valid = false;
    } else if (shopName.length < 3) {
        document.getElementById("shop_name_error").innerHTML = "Shop name must be at least 3 characters.";
        valid = false;
    }

    if (ownerName === "") {
        document.getElementById("owner_name_error").innerHTML = "Owner name is required.";
        valid = false;
    }

    if (businessType === "none") {
        document.getElementById("business_type_error").innerHTML = "Please select a valid business type.";
        valid = false;
    }

    if (license === "") {
        document.getElementById("license_error").innerHTML = "Please upload your business license.";
        valid = false;
    } else {
        const fileExt = license.toLowerCase();
        if (!fileExt.endsWith(".pdf") && !fileExt.endsWith(".jpg") && !fileExt.endsWith(".png")) {
            document.getElementById("license_error").innerHTML = "License must be a PDF, JPG, or PNG file.";
            valid = false;
        }
    }

    const phonePattern = /^[0-9]{11}$/;
    if (!phonePattern.test(contact)) {
        document.getElementById("contact_error").innerHTML = "Contact number must be exactly 11 digits.";
        valid = false;
    }

    return valid;
}
