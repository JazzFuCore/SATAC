import mariadb
import pandas as pd



####      ------   conexão BD   ------      ####
####      ------   conexão BD   ------      ####
####      ------   conexão BD   ------      ####


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




####      ------   carregamento do  XLSX   ------      ####
####      ------   carregamento do  XLSX   ------      ####
####      ------   carregamento do  XLSX   ------      ####


file_df = pd.read_excel('a.xlsx', 0, index_col=None)


if file_df.shape[1] != 21: #de4
    print("O ficheiro de entrada não tem 21 colunas")
    exit()



####      ------   leitura e inserção na BD   ------      ####
####      ------   leitura e inserção na BD   ------      ####
####      ------   leitura e inserção na BD   ------      ####




sql = conexao.cursor()


for x in range(1,file_df.shape[0]):   
    
    
    
    ####      ------   escolhe uma linha e avança   ------      ####
    ####      ------   escolhe uma linha e avança   ------      ####
    ####      ------   escolhe uma linha e avança   ------      ####
    
    
    Escolha = ['Node or area name','Counter value','Stream min.\n','Stream max.','Daily increase from the previous day','Current month increase']
    inConta_df = file_df.loc[x,Escolha]


    for y in range(0,len(Escolha)):
        
        
        
        ####      ------   percorre a linha   ------      ####
        ####      ------   percorre a linha   ------      ####
        ####      ------   percorre a linha   ------      ####
        
        
        

        if y == 0:
            id=inConta_df.iloc[y]
        elif y ==1:
            valor_medicao = inConta_df.iloc[y]
        elif y == 2:
            fluxo_min = inConta_df.iloc[y]
        elif y == 3:
            fluxo_max = inConta_df.iloc[y]
        elif y == 4:
            uso_dia_anterior = inConta_df.iloc[y]
        elif y == 5:
            uso_mes_atual=inConta_df.iloc[y]


    
    try:

        print(f'INSERT INTO medicao (contador_com_telemetria_id, valor_medicao, fluxo_min, fluxo_max, uso_dia_anterior, uso_mes_atual) VALUES (?,?,?,?,?,?)',(id, valor_medicao, fluxo_min, fluxo_max, uso_dia_anterior, uso_mes_atual))
        sql.execute(f'INSERT INTO medicao (contador_com_telemetria_id, valor_medicao, fluxo_min, fluxo_max, uso_dia_anterior, uso_mes_atual) VALUES (?,?,?,?,?,?)',(id, valor_medicao, fluxo_min, fluxo_max, uso_dia_anterior, uso_mes_atual))

        conexao.commit()
        print(f"linha {x} inserida")

    except:
        print("erro na inserção de dados")

conexao.close() ## fecha a conexão BD