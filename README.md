## Installation

**1. Get the app**:

Clone repo:

```bash
git clone https://github.com/regularuser548/product-rest-api.git
```

**2. Install Dependencies**:

> This app uses Laravel Sail

```bash
cd product-rest-api
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
cp .env.example .env
sail up -d
sail composer i && sail npm i && sail artisan key:generate && sail artisan storage:link && sail artisan migrate && sail artisan db:seed
```

**3. Open App**:
> http://localhost:50000
