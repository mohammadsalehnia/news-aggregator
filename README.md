## News Aggregator

This is a sample news aggregator website that pulls articles from various sources and serves them to the database.

### Features

- Fetch articles from multiple sources
- Filter articles based on various criteria
- Serve articles to the frontend application

### Installation

1. Clone the repository:
    ```sh
    git clone https://github.com/yourusername/news-aggregator.git
    cd news-aggregator
    ```

2. Install dependencies:
    ```sh
    composer install
    npm install
    ```

3. Copy the `.env.example` file to `.env` and update the environment variables:
    ```sh
    cp .env.example .env
    ```

4. Generate the application key:
    ```sh
    php artisan key:generate
    ```

5. Build the Docker containers:
    ```sh
    docker-compose up -d
    ```

### Usage

- To fetch data from the New York Times API, run the following command:
    ```sh
    php artisan fetch:data:newyorktimes
    ```

- To filter articles, use the API endpoint provided in the Postman collection.

### Postman API Collection

You can download the Postman collection from [here](https://drive.google.com/file/d/1UOYJjE_0dvyE1Z2XQr9TrCZj4jzxafPY/view?usp=sharing) and import it into your Postman application to use the APIs.
