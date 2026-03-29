# Database Entity Relationship Diagram (ERD)

This diagram outlines the core relational database structure for Abilidado Cebu.

```mermaid
erDiagram
    USERS {
        bigint id PK
        string name
        string email
        string password
        enum role "job_seeker, employer"
        boolean is_pwd "OCR Verified Status"
        timestamp created_at
    }

    JOBS {
        bigint id PK
        bigint employer_id FK
        string job_title
        decimal salary "Used for Tax Calculation"
        text description
        boolean minimum_wage_compliant "Automated check"
        json accessibility_features "Dual-Search Array"
        timestamp created_at
    }

    APPLICATIONS {
        bigint id PK
        bigint user_id FK
        bigint job_id FK
        string status "pending, reviewed, accepted, rejected"
        timestamp created_at
    }

    USERS ||--o{ JOBS : "posts (if employer)"
    USERS ||--o{ APPLICATIONS : "submits (if seeker)"
    JOBS ||--o{ APPLICATIONS : "receives"
