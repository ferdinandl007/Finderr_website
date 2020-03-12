#!/usr/bin/env python3

print("Hello")

import smtplib
import sys
import email.mime.multipart


sender = 'ckl41@srcf.net'
receivers = ['choonkiat.lee@gmail.com','ck@finderr.cf']

if len(sys.argv) > 1:
    message = sys.argv[1]
else:
    message = "Did not receive message from the PHP script"

try:
   smtpObj = smtplib.SMTP('localhost')
   smtpObj.sendmail(sender, receivers, message)         
   print ("Successfully sent email")
except SMTPException:
   print ("Error: unable to send email")


with open("output.txt","w") as outfile:
    outfile.write(message)