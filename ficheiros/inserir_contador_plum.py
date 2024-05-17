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


if file_df.shape[1] != 21:
    print("O ficheiro de entrada não tem 21 colunas")
    exit()



####      ------   leitura e inserção na BD   ------      ####
####      ------   leitura e inserção na BD   ------      ####
####      ------   leitura e inserção na BD   ------      ####




sql = conexao.cursor()


for x in range(1,file_df.shape[0]):   ### linha extra

    
    
    ####      ------   escolhe uma linha e avança   ------      ####
    ####      ------   escolhe uma linha e avança   ------      ####
    ####      ------   escolhe uma linha e avança   ------      ####
    
    
    Escolha = ['Node or area name','Street','Flow meter number','Geographical coordinates']
    inConta_df = file_df.loc[x,Escolha]


    for y in range(0,len(Escolha)):
        
        
        
        ####      ------   percorre a linha   ------      ####
        ####      ------   percorre a linha   ------      ####
        ####      ------   percorre a linha   ------      ####
        
        
        if inConta_df.iloc[y]:
            
            if y ==0:
                id=inConta_df.iloc[y]
            elif y ==1:
                nome=inConta_df.iloc[y]
            elif y ==2:
                num_contador=inConta_df.iloc[y]
            elif y ==3:
                GPS=inConta_df.iloc[y]


        else:
            print("##       ERRO ENTRADA  -  sem um valor      --->>>>>>>>>>>")
            # exit  # None, False

    try:
        plum_ewebtel = True

        print(f'INSERT INTO contador_com_telemetria (id,nome,num_contador,plum_ewebtel) VALUES (?,?,?,?)',(id,nome,num_contador,plum_ewebtel))
        sql.execute(f'INSERT INTO contador_com_telemetria (id,nome,num_contador,plum_ewebtel) VALUES (?,?,?,?)',(id,nome,num_contador,plum_ewebtel))
        conexao.commit()


    except:
        print("erro na inserção de dados")

    try:
        if len(GPS) > 0:
            print(f'UPDATE contador_com_telemetria SET GPS = ? WHERE id = ?', (GPS,id))
            sql.execute(f'UPDATE contador_com_telemetria SET GPS = ? WHERE id = ?', (GPS,id))
            conexao.commit()

        print(f"linha {x} atualizada")

    except:
        print('erro atualização GPS')

conexao.close() ## fecha a conexão BD