import mariadb
import requests
import json
import pandas as pd
import io
import zipfile
import datetime



api_key = ""
url = "https://www.temetra.com:443/wmsapp"


url1 = url + "/epoint/deltadata"
url1 += "?auth="+api_key
url1 += "&lastndays=90"


####  #f8f
try:
    conexao = mariadb.connect(  ## abre a conexão BD
        user = "",
        password = "",
        host = "localhost",
        port = 3306,
        database = "satacDB"
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


def file_s(text,nome,m):
    f = open(nome,m)
    f.write(text)
    f.close




####      ------   requisição Temetra, abertura da pasta zipada e selecção do ficheiro pretendido   ------      ####
####      ------   requisição Temetra, abertura da pasta zipada e selecção do ficheiro pretendido   ------      ####
####      ------   requisição Temetra, abertura da pasta zipada e selecção do ficheiro pretendido   ------      ####


req_1 = req(url1).content
zip1 = zipfile.ZipFile(io.BytesIO(req_1))

ziplist = zip1.namelist()[2]
file = zip1.open(ziplist,'r')
zip1.close()



####      ------   dataframe pandas   ------      ####
####      ------   dataframe pandas   ------      ####
####      ------   dataframe pandas   ------      ####


file_df = pd.read_csv(file,low_memory=False)


if file_df.shape[1] != 38:
    print("O ficheiro de entrada não tem 38 colunas")
    exit()




####      ------   leitura e inserção na BD   ------      ####
####      ------   leitura e inserção na BD   ------      ####
####      ------   leitura e inserção na BD   ------      ####


sql = conexao.cursor()  ## #f8f

Escolha = ['CREF','LOCALREADTIME','INDEXL']
inConta_df = file_df.loc[:,Escolha]


# Converter a coluna 'LOCALREADTIME' para datetime
inConta_df['LOCALREADTIME'] = pd.to_datetime(inConta_df['LOCALREADTIME'], format='%d/%m/%y %H:%M:%S')

# Convertendo valores da coluna 'INDEXL' para números, substituindo strings por NaN
inConta_df['INDEXL'] = pd.to_numeric(inConta_df['INDEXL'], errors='coerce')

# Preenchendo os valores NaN com 0
inConta_df['INDEXL'] = inConta_df['INDEXL'].fillna(0)



# Ordenar o DataFrame pelo CREF e pelo LOCALREADTIME
inConta_df.sort_values(by=['CREF', 'LOCALREADTIME'], inplace=True)

# Calcular a diferença entre valores consecutivos da coluna INDEXL
inConta_df['INDEXL_DIFF'] = inConta_df.groupby('CREF')['INDEXL'].diff()


# //                                                                 //
#0af
# Calcular o máximo da diferença de tempo mais afastada em um dia para a coluna INDEXL
daily_max_diff = inConta_df.groupby(['CREF', inConta_df['LOCALREADTIME'].dt.date])['INDEXL_DIFF'].max()

# Calcular o máximo da diferença de tempo mais afastada em um mês para a coluna INDEXL
# monthly_max_diff = inConta_df.groupby(['CREF', inConta_df['LOCALREADTIME'].dt.to_period('M')])['INDEXL_DIFF'].max()


# Calcular o mínimo da diferença de tempo mais afastada em um dia para a coluna INDEXL
daily_min_diff = inConta_df.groupby(['CREF', inConta_df['LOCALREADTIME'].dt.date])['INDEXL_DIFF'].min()

# Calcular o mínimo da diferença de tempo mais afastada em um mês para a coluna INDEXL
# monthly_min_diff = inConta_df.groupby(['CREF', inConta_df['LOCALREADTIME'].dt.to_period('M')])['INDEXL_DIFF'].min()
#0af
# //                                                                 //
#caf
# Calculando o valor gasto por dia
# inConta_df['DAY_EXPENSE'] = inConta_df.groupby([inConta_df['CREF'], inConta_df['LOCALREADTIME'].dt.date])['INDEXL_DIFF'].transform('sum')
DAY_EXPENSE = inConta_df.groupby([inConta_df['CREF'], inConta_df['LOCALREADTIME'].dt.date])['INDEXL_DIFF'].sum()

# Definir uma função personalizada para calcular a diferença entre o máximo e o mínimo
def diferenca_max_min(x):
    return x.max() - x.min()

inConta_df['MONTH'] = inConta_df['LOCALREADTIME'].dt.to_period('M')

# Usar groupby para agrupar por Produto e Loja e depois aplicar a função personalizada
monthly_total = inConta_df.groupby(['CREF', 'MONTH'])['INDEXL'].agg(diferenca_max_min)

# Calcular a diferença acumulada para cada mês
# inConta_df['total_diferença'] = inConta_df.groupby(inConta_df['CREF'])['INDEXL_DIFF'].sum().diff()
#caf


"""
    [ X ] fluxo_min 24h
        daily_min_diff
    [ X ] fluxo_max 24h
        daily_max_diff
    [ X ] uso_mes_atual
        monthly_total
    [ X ] uso_dia_anterior
        DAY_EXPENSE
"""

conta_linhas = 0

al = inConta_df.shape[1]

for x in range(0,file_df.shape[0]):   



    ####      ------   escolhe uma linha e avança   ------      ####
    ####      ------   escolhe uma linha e avança   ------      ####
    ####      ------   escolhe uma linha e avança   ------      ####


    aLinha_df = inConta_df.iloc[x]


    for y in range(0,al):
        
        
        
        ####      ------   percorre a linha   ------      ####
        ####      ------   percorre a linha   ------      ####
        ####      ------   percorre a linha   ------      ####
        
        
        if y == 0:
            id=aLinha_df.iloc[y]  # CREF
        elif y == 1:
            data = aLinha_df.iloc[y]  # LOCALREADTIME
            diaAtual = data.date()
            diaAnterior = data.date() - datetime.timedelta(1)
        elif y == 2:
            valor_medicao = aLinha_df.iloc[y]  # INDEXL
            #y == 3   --> INDEXL_DIFF
        elif y == 4:
            valor_mes = aLinha_df.iloc[y]  # MONTH



    fluxo_max = daily_max_diff.loc[(id, diaAtual)]

    fluxo_min = daily_min_diff.loc[(id, diaAtual)]


    try:
        uso_dia_anterior = DAY_EXPENSE.loc[(id, diaAnterior)]
    except:
        uso_dia_anterior = None


    try:
        uso_mes_atual = monthly_total.loc[(id, valor_mes)]
    except:
        uso_mes_atual = 0





# """    
    try:
        sql.execute(f'SELECT COUNT(*) FROM `medicao` WHERE `contador_com_telemetria_id` = ? AND `data` = ?',(str(id),str(data)))
        q = sql.fetchall()  #f8f
        # print(q[0][0])

        if q[0][0] == 0:
            # print(f'INSERT INTO medicao (contador_com_telemetria_id, data, valor_medicao, fluxo_min, fluxo_max, uso_dia_anterior, uso_mes_atual) VALUES (?,?,?,?,?,?,?)',(str(id), str(data), str(valor_medicao), str(fluxo_min), str(fluxo_max), str(uso_dia_anterior), str(uso_mes_atual)))
            sql.execute(f'INSERT INTO medicao (contador_com_telemetria_id, data, valor_medicao, fluxo_min, fluxo_max, uso_dia_anterior, uso_mes_atual) VALUES (?,?,?,?,?,?,?)',(str(id), str(data), str(valor_medicao), str(fluxo_min), str(fluxo_max), str(uso_dia_anterior), str(uso_mes_atual)))

            conta_linhas += 1

            conexao.commit()  #f8f

            if conta_linhas >= 50:
                print(f"linha {x} inserida")
                conta_linhas = 0

        else:
            sql.execute(f'UPDATE medicao SET uso_dia_anterior = ? WHERE uso_dia_anterior = "0" AND contador_com_telemetria_id = ? AND data = ?', (str(uso_dia_anterior),str(id),str(data)))
            
            conta_linhas += 1
            
            conexao.commit()  #f8f
            if conta_linhas >= 50:
                print(f"{q[0][0]} --> linha {x} já existe")
                conta_linhas = 0

    except:
        print("erro na inserção de dados")

conexao.close() ## fecha a conexão BD #f8f

# """
