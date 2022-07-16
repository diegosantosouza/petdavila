import os
import subprocess
import time
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.chrome.service import Service
from webdriver_manager.chrome import ChromeDriverManager

############################################################################################################
# Dependencies                                                                                             #
# Selenium -> pip install selenium                                                                         #
# Webdriver manager -> pip install webdriver-manager                                                       #
# Start on Windows -> C:\Users\current_user\AppData\Roaming\Microsoft\Windows\Start Menu\Programs\Startup\ #
############################################################################################################

# Verifies your os type
OS_TYPE = os.name
# Sets the count modifier to the os type
COUNT = '-n' if OS_TYPE == 'nt' else '-c'
# Endpoint
endpoint = "http://34.123.181.146"
# Credentials
username = ""
password = ""

def serviceInstance():
    while checkConnection() == False:
        print("Waiting for connection...")
        time.sleep(2)

    service = Service(ChromeDriverManager().install())
    service.start()
    return service

def checkConnection():
    response = os.popen(f"ping {endpoint[7:]} {COUNT} 1").read()
    return (bool("Recebidos = 1" in response))

def RegisterPage(service):
    # initialize the Chrome driver
    driver = webdriver.Chrome(service=service)

    driver.maximize_window()
    # login page
    driver.get(endpoint)

    driver.implicitly_wait(0.5)
    # find username/email field and send the username itself to the input field
    driver.find_element(by=By.NAME, value="email").send_keys(username)
    # find password input field and insert password as well
    driver.find_element(by=By.NAME, value="password_check").send_keys(password)
    # click login button
    driver.find_element(by=By.CLASS_NAME, value="icon-sign-in").click()
    time.sleep(5)
    driver.implicitly_wait(0.5)
    # register page
    driver.get(endpoint+"/registros/create")

def closeChromeInstances():
    subprocess.call("TASKKILL /f  /IM  CHROME.EXE")
    subprocess.call("TASKKILL /f  /IM  CHROMEDRIVER.EXE")
    print("Chrome instances closed")
    return

def main(service):
    while checkConnection() == False:
        print("Waiting for connection...")
        time.sleep(2)

    closeChromeInstances()
    RegisterPage(service)

# init service
service = serviceInstance()
# run main
main(service)

# loop for check connection
while True:
    if checkConnection() == True:
        time.sleep(10)

    if checkConnection() == False:
        print("Connection lost, restarting...")
        closeChromeInstances()
        while checkConnection() == False:
            time.sleep(10)
        main(service)


