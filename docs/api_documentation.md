# API Documentation: LGU PWD ID Verification

## Overview
As part of the Abilidado Cebu MVP, this application integrates a mock REST API to simulate communication with a Local Government Unit (LGU) registry. This API utilizes Optical Character Recognition (OCR) to extract text from uploaded PWD ID cards and verifies the data against our internal mock registry.

---

## Endpoint: Verify PWD ID

**URL:** `/api/verify-pwd`  
**Method:** `POST`  
**Auth Required:** Yes (Bearer Token / Session Cookie)  

### Description
Accepts an image upload of a PWD ID card, processes it through the OCR engine to extract the PWD Number and Full Name, and validates it against the `mock_lgu_registries` database table.

### Request Payload
**Content-Type:** `multipart/form-data`

| Parameter | Type | Required | Description |
| :--- | :--- | :--- | :--- |
| `id_image` | file (jpg, png) | Yes | The scanned image or photo of the user's PWD ID. |

### Example Request (JavaScript/Fetch)
```javascript
const formData = new FormData();
formData.append('id_image', fileInput.files[0]);

fetch('/api/verify-pwd', {
    method: 'POST',
    headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    },
    body: formData
});

Responses
Success (200 OK)
Returned when the OCR successfully reads the ID and finds a matching record in the LGU registry. The user's is_pwd boolean is subsequently flipped to true in the database.
{
    "status": "success",
    "message": "PWD ID successfully verified.",
    "data": {
        "pwd_number": "0722-1998-445A",
        "verified_name": "Juan Dela Cruz",
        "disability_type": "Orthopedic"
    }
}

Client Error: Not Found (404 Not Found)
Returned when the OCR extracts the data, but the PWD number does not exist in the mock LGU database (simulating a fake or expired ID).
{
    "status": "error",
    "message": "Verification failed. ID number not found in the active LGU registry."
}
