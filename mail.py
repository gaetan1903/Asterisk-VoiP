message = MIMEText('')
message['Subject'] = ''

message['From'] = ''
message['To'] = ''

server = smtplib.SMTP('smtp.gmail.com:587')
server.starttls()
server.login('gaetan.jonathan.bakary@esti.mg','**************')
server.send_message(message)
server.quit()
