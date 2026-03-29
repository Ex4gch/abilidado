# Core Business Logic & Algorithms

## 1. RA 10524 Tax Incentive Calculator
Private entities employing verified PWDs are entitled to an additional deduction from their gross income equivalent to 25% of the total amount paid as salaries and wages to PWDs.

**Algorithm Flow:**
1. Fetch all `Applications` where `status` == 'accepted'.
2. Eager load the `Job` (to access the salary) and the `User` (to access verification status).
3. **Guard Clause:** Filter the collection to strictly include Users where `is_pwd` == true.
4. **Calculation:** `(Monthly Salary * 12) * 0.25 = Estimated Tax Deduction`.
5. Display dynamically on the Employer Dashboard.

## 2. Dual-Interface Search Engine
To accommodate standard job hunters and accessibility-first users, the search engine utilizes two distinct filtering pipelines:
* **Traditional (String Matching):** Uses `LIKE %keyword%` across the `job_title`, `description`, and relational `employer->name` fields.
* **Needs-Based (JSON Querying):** Uses Laravel's `whereJsonContains` to filter the `accessibility_features` array (e.g., `wheelchair_ramp`, `sign_language`) and a boolean check for `minimum_wage_compliant`.

## 3. Minimum Wage Compliance Validator
Instead of relying on employer honesty, the system validates the input `salary` against the current Region VII (Cebu) minimum wage standard (approx. ₱13,130/month) during the `storeJob` request. If the threshold is met, the system automatically flags the job as compliant for the Dual-Interface Search.
