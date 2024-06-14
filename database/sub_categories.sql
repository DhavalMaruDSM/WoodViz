CREATE TABLE sub_categories (
    sub_category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT,
    sub_category_name VARCHAR(255) NOT NULL,
    FOREIGN KEY (category_id) REFERENCES categories(category_id)
);
