from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC

# Initialize the WebDriver
driver = webdriver.Chrome()

try:
    # Open the login page
    driver.get("http://localhost/499Capstone/html/login.html")

    # Find the username and password fields and enter valid credentials
    username_field = driver.find_element(By.ID, "username")
    password_field = driver.find_element(By.ID, "password")
    username_field.send_keys("user1")
    password_field.send_keys("Password1")

    # Click the login button
    login_button = driver.find_element(By.XPATH, "//input[@type='submit']")
    login_button.click()

    # Wait for the dashboard page to load
    WebDriverWait(driver, 10).until(EC.title_contains("Dashboard"))

    # Verify that the dashboard page is loaded successfully
    assert "Dashboard" in driver.title

    # If the assertion passes, print a success message
    print("Login test passed successfully.")

finally:
    # Close the browser window
    driver.quit()
