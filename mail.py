import sys, smtplib
from email.mime.text import MIMEText


def sendMail(isTo, isFrom, argent, nArgent):
    message = MIMEText('')
    message['Subject'] = f'''
        Vous avez reçu un transfert de {argent} Ar de la part du numero {isFrom}
        Vous nouveau solde est de {nArgent} Ar
    '''

    message['From'] = 'gaetan.jonathan.bakary@esti.mg'
    message['To'] = isTo

    server = smtplib.SMTP('smtp.gmail.com:587')
    server.starttls()
    server.login('gaetan.jonathan.bakary@esti.mg','**************')
    server.send_message(message)
    server.quit()


sendMail(sys.argv[1], sys.argv[2], sys.argv[3], sys.argv[4])