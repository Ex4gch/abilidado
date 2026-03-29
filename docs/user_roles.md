# User Roles & Access Control

The application utilizes a Role-Based Access Control (RBAC) system via Laravel Middleware to ensure data privacy and route protection.

### 1. The Job Seeker (PWD)
* **Default Status:** Unverified upon registration. Must upload an ID to trigger the `is_pwd` boolean.
* **Permissions:**
  * Access the Dual-Interface Job Search.
  * View detailed job postings.
  * Submit job applications (Prevented from submitting duplicate applications via database composite unique keys).
  * Access the Seeker Dashboard to track application statuses (Pending, Reviewed, Accepted, Rejected).
* **Restrictions:** Cannot access the Employer Dashboard or post jobs.

### 2. The Employer
* **Permissions:**
  * Access the Employer Dashboard.
  * Create job postings with custom Accessibility Audits (JSON array).
  * View all applicants for their specific job postings.
  * Update applicant tracking statuses.
  * Access the Automated Tax Incentive Reporter to track financial benefits of inclusive hires.
* **Restrictions:** Cannot apply for jobs.
