import mariadb
import requests
import json
import pandas as pd
import io
import datetime

today = datetime.date.today()
m90 = today - datetime.timedelta(90)  # conta 90 dias

api_key = ""
url = "https://www.temetra.com:443"


url1 = url + "/wmsapp/epoint/itrongenericcsv"
url1 += "?auth="+api_key
url1 += "&routenames="
url1 += f"&from={m90}"
url1 += f"&to={today}"



####  #f8f
try:
    conexao = mariadb.connect(  ## abre a conexão BD
        user = "",
        password = "",
        host = "localhost",
        port = 3306,
        database = "satacDB"
        # database = "test"
    )
except:
    print("erro na conexão")
    exit()




####      ------   conexão Temetra   ------      ####


def req(url):
    try:
        req = requests.get(url)
        if req.status_code != 200:
            print(f"erro conexão Temetra - {req}")
            exit()
        return req
    except requests.exceptions.RequestException as Err:
        print(f"ERRO conexão Temetra - URL??,...\n{url}")
        exit()




####      ------   escreve ficheiro   ------      ####


def file_s(text,f):
    f = open(f,"w")
    f.write(text)
    f.close




####      ------   requisição Temetra e dataframe pandas   ------      ####
####      ------   requisição Temetra e dataframe pandas   ------      ####
####      ------   requisição Temetra e dataframe pandas   ------      ####


file_df = pd.read_csv(io.StringIO(req(url1).content.decode('utf-8')))



if file_df.shape[1] != 44:
    print("O ficheiro de entrada não tem 44 colunas")
    print(url1)
    exit()



####      ------   leitura e inserção na BD   ------      ####
####      ------   leitura e inserção na BD   ------      ####
####      ------   leitura e inserção na BD   ------      ####




sql = conexao.cursor()  ## #f8f

plum_ewebtel = False
Escolha = ['CREF','CUSTOMERNAME','METERSERIAL','GPS']

erro = ""
cert = ""

for x in range(0,file_df.shape[0]):   
    
    
    
    ####      ------   escolhe uma linha e avança   ------      ####
    ####      ------   escolhe uma linha e avança   ------      ####
    ####      ------   escolhe uma linha e avança   ------      ####
    
    
    inConta_df = file_df.loc[x,Escolha]

    for y in range(0,len(Escolha)):
        
        
        
        ####      ------   percorre a linha   ------      ####
        ####      ------   percorre a linha   ------      ####
        ####      ------   percorre a linha   ------      ####
        
        
        if y ==0:
            id=str(inConta_df.iloc[y])
        elif y ==1:
            nome=str(inConta_df.iloc[y])
        elif y ==2:
            num_contador=str(inConta_df.iloc[y])
        elif y ==3:
            GPS=str(inConta_df.iloc[y])


    try:
        sql.execute(f'SELECT COUNT(*) FROM `contador_com_telemetria` WHERE `id` = ? AND `num_contador` = ?',(str(id),str(num_contador)))
        q = sql.fetchall()  #f8f
        # print(q[0][0])

        if q[0][0] == 0:
            print(f'INSERT INTO contador_com_telemetria (id,nome,num_contador,GPS,plum_ewebtel) VALUES (?,?,?,?,?) ON DUPLICATE KEY UPDATE nome = ? , num_contador = ? , GPS = ? , plum_ewebtel = ?',(id,nome,num_contador,GPS,plum_ewebtel, nome,num_contador,GPS,plum_ewebtel))
            sql.execute(f'INSERT INTO contador_com_telemetria (id,nome,num_contador,GPS,plum_ewebtel) VALUES (?,?,?,?,?) ON DUPLICATE KEY UPDATE nome = ? , num_contador = ? , GPS = ? , plum_ewebtel = ?',(id,nome,num_contador,GPS,plum_ewebtel, nome,num_contador,GPS,plum_ewebtel))

            conexao.commit() ## #f8f
            # cert += "\n" + "linha " + str(x) 
            print(f"linha {x} inserida")
        else:
            print(f"{q[0][0]} --> linha {x} já existe")
    except:
        print("erro na inserção de dados")
        # erro += "\n" + "linha " + str(x) # + "\t" + str(Exception)
        # pass

# err_p = f"TMP_ERRO_{datetime.date.today()}.txt"
# file_s(erro,err_p)

# err_n = f"TMP_CERT_{datetime.date.today()}.txt"
# file_s(cert,err_n)


conexao.close() ## fecha a conexão BD #f8f
