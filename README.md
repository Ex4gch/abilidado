Abilidado Cebu ♿️ 💼
Cebu's Premier Inclusive Hiring Portal

📖 Project Overview
Abilidado Cebu is a dedicated job portal designed to bridge the gap between Persons with Disabilities (PWDs) and equal-opportunity employers in Cebu. Traditional job boards force users to search by job title and hope the office is accessible. Our platform flips that dynamic, allowing candidates to search based on their physical and sensory needs while providing employers with financial incentives to build inclusive teams.

**Sustainable Development Goals (SDGs) Addressed:**
SDG 8 (Decent Work and Economic Growth):** Promoting inclusive and sustainable economic growth, employment, and decent work for all.

**Core MVP Features:**
* **LGU ID Verification:** Built-in OCR scanner to securely verify local government PWD IDs.
* **Dual-Interface Search:** A unique search engine allowing users to filter by traditional skills or strict workplace accessibility needs (e.g., wheelchair ramps, sign language support).
* **RA 10524 Tax Incentive Reporter:** An automated employer dashboard that tracks inclusive hires and calculates the 25% BIR tax deduction incentive in real-time.
* **Minimum Wage Compliance:** Automated filtering to ensure job postings meet regional labor standards.

---

🛠 Tech Stack
* **Framework:** Laravel (PHP)
* **Frontend:** Blade Templating, Tailwind CSS, Alpine.js
* **Database:** MySQL
* **Authentication:** Laravel Breeze (Role-Based Access Control)


## 🚀 How to Run / Install

1. Navigate to the source code:

   cd src

2. Install PHP and Node dependencies:
    composer install
    npm install

3. Environment Setup:
Copy the example environment file and generate your application key:
    cp .env.example .env
    php artisan key:generate

4.Database Setup:
Create a MySQL database named abilidado_cebu. Then, run the migrations and seeders to populate the mock PWD registries and fake job listings:
    php artisan migrate:fresh --seed

5.Launch the Application:
    npm run dev
    php artisan serve

Sample Credentials
Use these accounts to explore the different Role-Based Access views:
Employer Account:

Email: employer@test.com

Password: password

Notes: Accesses the Tax Incentive Dashboard and applicant review system.

Job Seeker Account (Verified PWD):

Email: pwd@test.com

Password: password

Notes: Has access to the Dual-Interface Search and can submit applications.

