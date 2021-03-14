"use strict"


var stateObject = {
    "Aveiro": { "Águeda": ["Aguada de Cima", "Angeja" , "Branca", "São João de Loure e Frossos"],
            "Anadia": ["Amoreira da Gândara", "Paredes do Bairro e Ancas", "Moita","Sangalhos","Vilarinho do Bairro"],
            "Arouca": ["Alvarenga", "Escariz","Rossas","Várzea"],
            "Aveiro": ["Aradas", "Glória e Vera Cruz","Santa Joana","São Jacinto"],
            "Castelo de Paiva": ["Fornos", "Real","São Martinho de Sardoura","Sobrado e Bairros"],
            "Espinho": ["Anta e Guetim", "Espinho","Paramos","Silvalde"],
            "Estarreja": ["Avanca", "Beduído e Veiros ","Canelas e Fermelã","Salreu "],
            "Ílhavo": ["Gafanha da Encarnação", "Gafanha da Nazaré","Gafanha do Carmo","Ílhavo"],
            "Mealhada": ["Barcouço", "Luso","Pampilhosa","Vacariça"],
            "Murtosa": ["Bunheiro", "Monte","Murtosa","Torreira"],
            "Oliveira de Azeméis": ["Carregosa", "Fajões","Oliveira de Azeméis, Santiago de Riba-Ul, Ul, Macinhata da Seixa e Madail","Ossela"],
            "Oliveira do Bairro": ["Bustos, Troviscal e Mamarrosa", "Oiã","Oliveira do Bairro","Palhaça"],
            "Ovar": ["Cortegaça", "Esmoriz","União das Freguesias de Ovar, São João, Arada e São Vicente de Pereira Jusã","Válega"],
            "Santa Maria da Feira": ["Argoncilhe", "Canedo, Vale e Vila Maior","Lobão, Gião, Louredo e Guisande","Paços de Brandão"],
            "São João da Madeira": ["São João da Madeira"],
            "Sever do Vouga" : ["Cedrim e Paradela" ,"Couto de Esteves" ,"Rocas do Vouga" ,"Talhadas" ],
            "Vagos" : ["Calvão" ,"Fonte de Angeão e Covão do Lobo" ,"Ouca" ,"Vagos e Santo António" ],
            "Vale de Cambra" : ["Arões" ,"Cepelos" ,"Macieira de Cambra" ,"Vila Chã, Codal e Vila Cova de Perrinho" ]
            
}, 

"Beja": { "Aljustrel": ["Aljustrel e Rio de Moinhos", "Ervidel" , "Messejana", "São João de Negrilhos"],
            " Almodôvar": ["Aldeia dos Fernandes","Almodôvar e Graça dos Padrões", "Rosário","São Barnabé","Santa Cruz"],
            "Alvito": ["Alvito ","Vila Nova da Baronia"],
            "Barrancos": ["Barrancos"],
            "Beja": ["Albernoa e Trindade","Beja (Santiago Maior e São João Baptista)","Salvada e Quintos","São Matias"],
            "Castro Verde": ["Castro Verde e Casével", "Entradas","Santa Bárbara de Padrões","São Marcos da Ataboeira"],
            "Cuba": ["Cuba", "Faro do Alentejo","Vila Ruiva"],
            "Ferreira do Alentejo": ["Alfundão e Peroguarda", "Ferreira do Alentejo e Canhestros","Figueira dos Cavaleiros","Odivelas"],
            "Mértola": ["Alcaria Ruiva", "Espírito Santo","Mértola","São Miguel do Pinheiro, São Pedro de Solis e São Sebastião dos Carros"],
            "Moura": ["Amareleja", "Póvoa de São Miguel","Safara e Santo Aleixo da Restauração","Sobral da Adiça"],
            "Odemira": ["Boavista dos Pinheiros", "Colos","São Luís","Vila Nova de Milfontes"],
            "Ourique": ["Garvão e Santa Luzia", "Ourique","Panoias e Conceição","Santana da Serra"],
            "Serpa": ["Brinches", "Pias","Vila Nova de São Bento e Vale de Vargo","Vila Verde de Ficalho"],
            "Vidigueira": ["Pedrógão", "Selmes","Vidigueira","Vila de Frades"]
 },

 "Braga": { "Amares": ["Amares e Figueiredo", "Dornelas" , "Santa Maria do Bouro", "Vilela, Seramil e Paredes Secas"],    
         "Barcelos": ["Abade de Neiva", "Barcelos, Vila Boa e Vila Frescainha" , "Carreira e Fonte Coberta", "Fragoso"],   
         "Braga": ["Adaúfe", "Lomar e Arcos" , "Padim da Graça", "Priscos"],   
         "Cabeceiras de Basto": ["Abadim", "Cavez" , "Pedraça", "Rio Douro"],   
         "Celorico de Basto": ["Agilde", "Borba de Montanha" , "Fervença", "Veade, Gagos e Molares"],   
         "Esposende": ["Antas", "Belinho e Mar" , "Fonte Boa e Rio Tinto", "Vila Chã"],   
         "Fafe": ["Armil", "Monte e Queimadela" , "Santa Cristina de Arões", "Vinhós"],   
         " Guimarães": ["Caldelas", "Infantas" , "Mesão Frio", "Souto e Gondomar"],   
         " Póvoa de Lanhoso": ["Águas Santas e Moure", "Fonte Arcada e Oliveira" , "Geraz do Minho", "Vilela"],   
          "Terras de Bouro": ["Balança", "Cibões e Brufe" , "Moimenta", "Vilar da Veiga"],   
          " Vieira do Minho": ["Anissó e Soutelo", "Cantelães" , "Ruivães e Campos", "Vieira do Minho"],  
         "Vila Nova de Famalicão": ["Arnoso e Sezures", "Bairro" , "Landim", "Vila Nova de Famalicão e Calendário"],
         "Vila Verde": ["Atiães", "Cabanelas" , "Parada de Gatim", "Vila Verde e Barbudo"],
         "Vizela": ["Caldas de Vizela ", "Santa Eulália" , "Santo Adrião de Vizela", "Tagilde e Vizela"]
},

" Bragança": { "Alfândega da Fé": ["Agrobom, Saldonha e Vale Pereiro", "Cerejais" , "Vilar Chão", "Vilarelhos"],    
        "Bragança": ["Alfaião","Baçal","Grijó de Parada","Serapicos"],
        "Carrazeda de Ansiães": ["Amedo e Zedes","Carrazeda de Ansiães","Marzagão","Seixo de Ansiães"],
        "Freixo de Espada à Cinta": ["Freixo de Espada à Cinta e Mazouco","Lagoaça e Fornos","Ligares","Poiares"],
        "Macedo de Cavaleiros": ["Ala e Vilarinho do Monte","Castelãos e Vilar do Monte","Cortiços","Vale de Prados"],
        "Miranda do Douro": ["Duas Igrejas","Palaçoulo","Póvoa","Vila Chã de Braciosa"],
        "Mirandela": ["Abambres","Barcel, Marmelos e Valverde da Gestosa","Cobro","Vale de Telhas"],
        "Mogadouro": ["Bruçó","Brunhozinho, Castanheira e Sanhoane","Meirinhos","Vilarinho dos Galegos e Ventozelo"],
        "Torre de Moncorvo": ["Açoreira","Felgar e Souto da Velha","Felgueiras e Maçores","Urros e Peredo dos Castelhanos"],
        "Vila Flor": ["Assares e Lodões","Roios","Santa Comba de Vilariça","Trindade"],
        "Vimioso": ["Argozelo","Vilar Seco","Vimioso"],
        "Vinhais": ["Agrochão","Candedo","Curopos e Vale de Janeiro","Travanca e Santa Cruz"]
},
" Castelo Branco": { "Castelo Branco": ["Alcains, Saldonha e Vale Pereiro", "Castelo Branco" , "Cebolais de Cima e Retaxo", "Lardosa"],    
        "Covilhã": ["Aldeia de São Francisco de Assis","Boidobra","Paul","Sobral de São Miguel"],
        "Fundão": ["Alcaria","Castelo Novo","Pêro Viseu","Três Povos"],
        "Idanha-a-Nova": ["Idanha-a-Nova e Alcafozes","Ladoeiro","Medelim","São Miguel de Acha"],
        "Oleiros": ["Estreito - Vilar Barroco","Madeirã","Sarnadas de São Simão","Sobral"],
        "Penamacor": ["Aranhas","Benquerença","Pedrógão de São Pedro e Bemposta","Vale da Senhora da Póvoa"],
        "Proença-a-Nova": ["Montes da Senhora","Proença-a-Nova e Peral","São Pedro do Esteval","Sobreira Formosa e Alvito da Beira"],
        "Sertã": ["Cabeçudo","Castelo","Sertã","Várzea dos Cavaleiros"],
        "Vila de Rei": ["Fundada","São João do Peso","Vila de Rei"],
        "Vila Velha de Ródão": ["Fratel","Perais","Sarnadas de Ródão","Vila Velha de Ródão"]
        
},
" Coimbra": { "Arganil": ["Arganil", "Celavisa" , "Pombeiro da Beira", "Vila Cova de Alva e Anseriz"],    
        "Cantanhede": ["Covões e Camarneira","Sanguinheira","Vilamar e Corticeiro de Cima","Tocha"],
        "Coimbra": ["Almalaguês","Cernache","Coimbra","Torres do Mondego"],
        "Condeixa-a-Nova": ["Anobra","Furadouro","Sebal e Belide","Zambujal"],
        "Figueira da Foz": ["Alhadas","Lavos","Marinha das Ondas","Tavarede"],
        "Góis": ["Alvares","União das Freguesias de Cadafaz e Colmeal","Góis","Vila Nova do Ceira"],
        "Lousã": ["Foz de Arouce e Casal de Ermio","Gândaras","Lousã e Vilarinho","Serpins"],
        "Mira": ["Carapelhos","Mira","Praia de Mira","Seixo"],
        "Miranda do Corvo": ["Lamas","Miranda do Corvo","Semide e Rio Vide","Vila Nova"],
        "Montemor-o-Velho": ["Arazede","Ereira","Montemor-o-Velho e Gatões","Tentúgal"],
        "Oliveira do Hospital": ["Aldeia das Dez","Bobadela","Meruge","Oliveira do Hospital e São Paio de Gramaços"],
        "Pampilhosa da Serra": ["Cabril","Fajão - Vidual","Pampilhosa da Serra","Unhais-o-Velho"],
        "Penacova": ["Carvalho","Figueira de Lorvão","Penacova","Sazes do Lorvão"],
        "Penela": ["Cumeeira","Espinhal","Podentes","São Miguel, Santa Eufémia e Rabaçal"],
        "Soure": ["Alfarelos","Samuel","Tapéus","Vila Nova de Anços"],
        "Tábua": ["Ázere e Covelo","Covas e Vila Nova de Oliveirinha","Midões","Tábua"],
        "Vila Nova de Poiares": ["Arrifana","Lavegadas","Poiares","São Miguel de Poiares"]   
        
},
" Évora": { "Alandroal": ["Alandroal, São Brás dos Matos e Juromenha", "Capelins" , "Santiago Maior", "Terena"],    
        "Arraiolos": ["Arraiolos","Gafanhoeira e Sabugueiro","São Gregório e Santa Justa","Vimieiro"],
        "Borba": ["Matriz","Orada","Rio de Moinhos","São Bartolomeu"],
        "Estremoz": ["Ameixial","Estremoz","São Domingos de Ana Loura","Veiros"],
        "Évora": ["Évora","Nossa Senhora da Graça do Divor","São Manços e São Vicente do Pigeiro","Torre de Coelheiros"],
        "Montemor-o-Novo": ["Cabrela","Cortiçadas de Lavre e Lavre","Santiago do Escoural","São Cristóvão"],
        "Mora": ["Cabeção","Mora","Pavia"],
        "Mourão": ["Granja","Luz","Mourão"],
        "Portel": ["Amieira e Alqueva","Monte do Trigo","Portel","Santana"],
        "Redondo": ["Montoito","Redondo"],
        "Reguengos de Monsaraz": ["Campo e Campinho","Monsaraz","Reguengos de Monsaraz"],
        "Vendas Novas": ["Landeira","Vendas Novas"],
        "Viana do Alentejo": ["Aguiar","Alcáçovas","Viana do Alentejo"],
        "Vila Viçosa": ["Nossa Senhora da Conceição e São Bartolomeu","Bencatel","Ciladas","Pardais"],

},
" Faro": { "Albufeira": ["Albufeira e Olhos de Água", "Ferreiras" , "Guia", "Paderne"],    
        "Alcoutim": ["Alcoutim e Pereiro","Giões","Martim Longo","Vaqueiros"],
        "Aljezur": ["Aljezur","Odeceixe"],
        "Castro Marim": ["Altura","Castro Marim","Odeleite"],
        "Faro": ["Conceição e Estoi","Faro","Montenegro","Santa Bárbara de Nexe"],
        "Lagoa": ["Estômbar e Parchal","Ferragudo","Lagoa e Carvoeiro","Porches"],
        "Lagos": ["Bensafrim e Barão de São João","São Gonçalo de Lagos","Luz","Odiáxere"],
        "Loulé": ["Almancil","Alte","Ameixial","Alto Fico e Benafim"],
        "Monchique": ["Alferce","MarmeleteC","Monchique"],
        "Olhão": ["Moncarapacho e Fuseta","Olhão","Pechão","Quelfes"],
        "Portimão": ["Alvor","Mexilhoeira Grande","Portimão"],
        "São Brás de Alportel": ["São Brás de Alportel"],
        "Silves": ["Algoz e Tunes","São Bartolomeu de Messines","São Marcos da Serra","Silves"],
        "Tavira": ["Cachopo","Luz de Tavira e Santo Estêvão ","Santa Luzia","Tavira "],
        "Vila do Bispo": ["Barão de São Miguel","Sagres","Vila do Bispo e Raposeira"],
        "Vila Real de Santo António": ["Vila Nova de Cacela","Monte Gordo","Vila Real de Santo António"]





},
" Guarda": { "Aguiar da Beira": ["Carapito", "Dornelas" , "Pinheiro", "Sequeiros e Gradiz"],    
        "Almeida": ["Almeida","Freineda","Malhada Sorda","Vale da Mula"],
        "Celorico da Beira": ["Baraçal","Forno Telheiro","Maçal do Chão","Ratoeira"],
        "Figueira de Castelo Rodrigo": ["Almofala e Escarigo","Cinco Vilas e Reigada","Colmeal e Vilar Torpim","Vermiosa"],
        "Fornos de Algodres": ["Algodres","Cortiçô e Vila Chã","Juncais, Vila Ruiva e Vila Soeiro do Chão","Sobral Pichorro e Fuinhas"],
        "Gouveia": ["Aldeias e Mangualde da Serra","Nespereira","Vila Franca da Serra"],
        "Guarda": ["Aldeia do Bispo","Casal de Cinza","Famalicão","Vila Franca do Deão"],
        "Manteigas": ["Sameiro","Santa Maria","São Pedro","Vale de Amoreira"],
        "Mêda": ["	Aveloso","Longroiva","Mêda, Outeiro de Gatos e Fonte Longa","Vale Flor, Carvalhal e Pai Penela"],
        "Pinhel": ["Alto do Palurdo","Freixedas","Manigoto","Terras de Massueime"],
        "Sabugal": ["Águas Belas","Aldeia Velha","Bismula","Rendo"],
        "Seia": ["Alvoco da Serra","Loriga","Santa Marinha e São Martinho","Vila Cova à Coelheira "],
        "Trancoso": ["Aldeia Nova","Moimentinha","Póvoa do Concelho","Reboleiro"],
        "Vila Nova de Foz Côa": ["Almendra","Cedovim","Muxagata","Santa Comba"]
},

" Leiria": { "Alcobaça": ["Aljubarrota", "Évora de Alcobaça" , "Turquel", "Vimeiro"],    
        "Alvaiázere": ["Almoster","Alvaiázere ","Maçãs de Dona Maria","Pussos São Pedro"],
        "Ansião": ["Ansião","Chão de Couce","Pousaflores","Santiago da Guarda"],
        "Batalha": ["Batalha","Golpilheira","São Mamede"],
        "Bombarral": ["Bombarral e Vale Covo","Pó","Roliça"],
        "Caldas da Rainha": ["A dos Francos","Nadadouro","Santa Catarina","Vidais"],
        "Castanheira de Pera": ["Castanheira de Pera"],
        "Figueiró dos Vinho": ["Aguda","Arega","Campelo","Figueiró dos Vinhos e Bairradas"],
        "Leiria": ["Amor","Bidoeira de Cima","Coimbrão","Santa Eufémia e Boa Vista"],
        "Marinha Grande": ["Marinha Grande","Moita"],
        "Nazaré": ["Famalicão","Nazaré","Valado dos Frades"],
        "Óbidos": ["A-dos-Negros","Amoreira","Olho Marinho","Vau"],
        "Pedrógão Grande": ["Graça","Pedrógão Grande","Vila Facaia"],
        "Peniche": ["Atouguia da Baleia","Ferrel","Serra d'El-Rei"],
        "Pombal": ["Almagreira","Guia, Ilha e Mata Mourisca","Pelariga","Pombal"],
        "Porto de Mós": ["Alqueidão da Serra","Mira de Aire","Porto de Mós - São João Baptista e São Pedro","Serro Ventoso"]

},
" Lisboa": { "Alenquer": ["Alenquer", "Carregado e Cadafais" , "Ribafria e Pereiro de Palhacana", "Vila Verde dos Francos"],    
        "Amadora": ["Águas Livres","Encosta do Sol","Mina de Água","Venteira"],
        "Azambuja": ["Alcoentre","Azambuja","Vale do Paraíso","Vila Nova da Rainha"],
        "Cadaval": ["Alguber","Peral","Vermelha","Vilar"],
        "Cascais": ["Alcabideche","Carcavelos e Parede","Cascais e Estoril","São Domingos de Rana"],
        "Lisboa": ["Ajuda","Alvalade","Belém","Marvila","Outra"],
        "Loures": ["Bucelas","Fanhões","Loures","Santo António dos Cavaleiros e Frielas"],
        "Lourinhã": ["Lourinhã e Atalaia","Reguengo Grande","Ribamar","Santa Bárbara"],
        "Mafra": ["Azueira e Sobral da Abelheira","Carvoeira","Mafra","Venda do Pinheiro e Santo Estêvão das Galés"],
        "Odivelas": ["Odivelas","Pontinha e Famões","Póvoa de Santo Adrião e Olival Basto","Ramada e Caneças"],
        "Oeiras": ["Algés, Linda-a-Velha e Cruz Quebrada-Dafundo","Barcarena","Oeiras e São Julião da Barra, Paço de Arcos e Caxias","Porto Salvo"],
        "Sintra": ["Casal de Cambra","Queluz e Belas","Rio de Mouro","Sintra"],
        "Sobral de Monte Agraço": ["Santo Quintino","Sapataria","Sobral de Monte Agraço"],
        "Torres Vedras": ["Ramalhal","Turcifal","Ventosa"],
        "Vila Franca de Xira": ["Alhandra, São João dos Montes e Calhandriz","Póvoa de Santa Iria e Forte da Casa","Vialonga"]
},
" Portalegre": { "Alter do Chão": ["Alter do Chão", "Chancelaria" , "Cunheira", "Seda"],    
        "Arronches": ["Assunção","Esperança","Mosteiros"],
        "Avis": ["Alcórrego e Maranhão","Avis","Ervedal","Figueira e Barros"],
        "Campo Maior": ["Nossa Senhora da Expectação","Nossa Senhora da Graça dos Degolados","São João Baptista"],
        "Castelo de Vide": ["Nossa Senhora da Graça de Póvoa e Meadas","Santa Maria da Devesa","Santiago Maior","São João Baptista"],
        "Crato": ["Aldeia da Mata","Crato e Mártires, Flor da Rosa e Vale do Peso","Gáfete ","Monte da Pedra"],
        "Elvas": ["Assunção, Ajuda, Salvador e Santo Ildefonso","Santa Eulália","São Brás e São Lourenço","Terrugem e Vila Boim"],
        "Fronteira": ["Cabeço de Vide","Fronteira","São Saturnino"],
        "Gavião": ["Belver","Comenda","Gavião e Atalaia","Margem"],
        "Marvão": ["Beirã","Santa Maria de Marvão","Santo António das Areias","São Salvador da Aramenha"],
        "Monforte": ["Assumar","Monforte","Santo Aleixo","Vaiamonte"],
        "Nisa": ["Alpalhão","Arez e Amieira do Tejo","Espírito Santo, Nossa Senhora da Graça e São Simão","São Matias"],
        "Ponte de Sor": ["Foros de Arrão","Galveias","Montargil","Ponte de Sor, Tramaga e Vale de Açor"],
        "Portalegre": ["Alagoa","Alegrete","Reguengo e São Julião","Urra"],
        "Sousel": ["Cano","Casa Branca","Santo Amaro"]
    
},
" Porto": { "Amarante": ["Aboadela, Sanche e Várzea", "Candemil" , "Fridão", "Vila Garcia, Aboim e Chapa"],    
        "Baião": ["Ancede e Ribadouro","Gestaçô","Loivos da Ribeira e Tresouras","Viariz"],
        "Felgueiras": ["Aião","Jugueiros","Penacova","Vila Cova da Lixa e Borba de Godim"],
        "Gondomar": ["Baguim do Monte ","Foz do Sousa e Covelo","Lomba","Rio Tinto"],
        "Lousada": ["Aveleda","Lodares","Nespereira e Casais","Silvares, Pias, Nogueira e Alvarenga"],
        "Maia": ["Águas Santas","Folgosa","Nogueira e Silva Escura","Vila Nova da Telha"],
        "Marco de Canaveses": ["Avessadas e Rosém","Constance","Penhalonga e Paços de Gaiolo","Vila Boa de Quires e Maureles"],
        "Matosinhos": ["Custóias, Leça do Balio e Guifões ","Matosinhos e Leça da Palmeira","Perafita, Lavra e Santa Cruz do Bispo","São Mamede de Infesta e Senhora da Hora"],
        "Paços de Ferreira": ["Ferreira","Freamunde","Paços de Ferreira","Seroa"],
        "Paredes": ["Aguiar de Sousa","Lordelo","Duas Igrejas","Recarei"],
        "Penafiel": ["Abragão","Castelões","Fonte Arcada","Irivo"],
        "Porto": ["Aldoar, Foz do Douro e Nevogilde","Bonfim","Paranhos","União das Freguesias de Lordelo do Ouro e Massarelos "],
        "Póvoa de Varzim": ["Aguçadoura e Navais","Balazar","Laúndos","São Pedro de Rates"],
        "Santo Tirso": ["Água Longa","Rebordões","Santo Tirso, Couto (Santa Cristina e São Miguel) e Burgães","Vilarinho"],
        "Trofa": ["Alvarelhos e Guidões","Coronado","Covelas","Muro"],
        "Valongo": ["Alfena","Ermesinde ","Campo e Sobrado","Valongo"],
        "Vila do Conde": ["Azurara","Guilhabreu","Junqueira","Vila do Conde"],
        "Vila Nova de Gaia": ["Canidelo","Madalena","Sandim, Olival, Lever e Crestuma","São Félix da Marinha"]
        
        
},
" Santarém": { "Abrantes": ["Abrantes e Alferrarede", "Bemposta" , "Mouriscas", "São Miguel do Rio Torto e Rossio ao Sul do Tejo"],    
        "Alcanena": ["Bugalhos","Minde","Moitas Venda","Serra de Santo António"],
        "Almeirim": ["Almeirim","Benfica do Ribatejo","Fazendas de Almeirim","Raposa"],
        "Alpiarça": ["Alpiarça"],
        "Benavente": ["Barrosa","Benavente","Samora Correia","Santo Estêvão"],
        "Cartaxo": ["Cartaxo","Vale da Pinta","Valada","Pontével"],
        "Chamusca": ["Carregueira","Parreira e Chouto","Vale de Cavalos"],
        "Constância": ["Constância","Montalvo","Santa Margarida da Coutada"],
        "Coruche": ["Biscainho","Coruche, Fajarda e Erra","Santana do Mato","São José da Lamarosa"],
        "Entroncamento": ["São João Baptista","Nossa Senhora de Fátima"],
        "Ferreira do Zêzere": ["Águas Belas","Chãos","Ferreira do Zêzere","Nossa Senhora do Pranto"],
        "Golegã": ["Azinhaga","Golegã","Pombalinho"],
        "Mação": ["Amêndoa","Envendos","Mação, Penhascoso e Aboboreira","Ortiga"],
        "Ourém": ["Caxarias","Freixianda, Ribeira do Fárrio e Formigais","Nossa Senhora das Misericórdias","Urqueira"],
        "Rio Maior": ["Arrouquelas","Fráguas","Marmeleira e Assentiz","Rio Maior"],
        "Salvaterra de Magos": ["Glória do Ribatejo e Granho","Marinhais","Muge","Salvaterra de Magos e Foros de Salvaterra"],
        "Santarém": ["Alcanede","Amiais de Baixo","Póvoa da Isenta","União de Freguesias da cidade de Santarém"],
        "Sardoal": ["Alcaravela","Santiago de Montalegre","Sardoal","Valhascos"],
        "Tomar": ["Além da Ribeira e Pedreira","Casais e Alviobeira","Sabacheira","Tomar e Santa Maria dos Olivais"],
        "Torres Novas": ["Assentiz","Olaia e Paço","Santa Maria, Salvador e Santiag","Zibreira"]     
},
" Setúbal": { "Alcácer do Sal": ["Alcácer do Sal e Santa Susana", "Comporta" , "São Martinho", "Torrão"],    
        "Alcochete": ["Alcochete","Samouco","São Francisco"],
        "Almada": ["Caparica e Trafaria","Costa de Caparica","Laranjeiro e Feijó "],
        "Barreiro": ["Alto do Seixalinho, Santo André e Verderena","Barreiro e Lavradio","Palhais e Coina","Santo António da Charneca"],
        "Grândola": ["Azinheira dos Barros e São Mamede do Sádão","Carvalhal","Grândola e Santa Margarida da Serra","Melides"],
        "Moita": ["Alhos Vedros","Baixa da Banheira e Vale da Amoreira","Gaio-Rosário e Sarilhos Pequenos","Moita"],
        "Montijo": ["Atalaia e Alto Estanqueiro-Jardia","Montijo e Afonsoeiro","Pegões","Sarilhos Grandes"],
        "Palmela": ["Palmela","Palmela Novo","Poceirão e Marateca","Quinta do Anjo"],
        "Santiago do Cacém": ["Santiago do Cacém, Santa Cruz e São Bartolomeu da Serra","Alvalade","Ermidas-Sado","São Francisco da Serra"],
        "Seixal": ["Amora","Corroios","Fernão Ferro","Seixal, Arrentela e Aldeia de Paio Pires"],
        "Sesimbra": ["Castelo","Quinta do Conde","Santiago "],
        "Setúbal": ["Gâmbia - Pontes - Alto da Guerra","Sado","São Julião","São Sebastião"],
        "Sines": ["Porto Covo","Sines"]

},
" Viana do Castelo": { "Arcos de Valdevez": ["Aboim das Choças", "Arcos de Valdevez, Vila Fonche e Parada" , "Oliveira", "Rio de Moinhos"],    
        "Caminha": ["Caminha e Vilarelho","Gondar e Orbacém","Vilar de Mouros","Vile"],
        "Melgaço": ["Castro Laboreiro e Lamas de Mouro","Parada do Monte e Cubalhão","Penso","Prado e Remoães"],
        "Monção": ["Cambeses","Messegães, Valadares e Sá","Portela","Trute"],
        "Paredes de Coura": ["Cossourado e Linhares","Insalde e Porreiras","Paredes de Coura e Resende","Vascões"],
        "Ponte da Barca": ["Bravães","Crasto, Ruivos e Grovelas","Ponte da Barca, Vila Nova de Muía e Paço Vedro de Magalhães","São Pedro de Vade"],
        "Ponte de Lima": ["Beiral do Lima","Calvelo","Fornelos e Queijada","Labrujó, Rendufe e Vilar do Monte"],
        "Valença": ["União das Freguesias de Valença, Cristelo Covo e Arão","Gondomil e Sanfins","São Julião e Silva","Verdoejo"],
        "Viana do Castelo": ["Areosa","Chafé","Nogueira, Meixedo e Vilar de Murteda","Viana do Castelo (Santa Maria Maior e Monserrate) e Meadela"],
        "Vila Nova de Cerveira": ["Campos e Vila Meã","Gondarém","Reboreda e Nogueira","Vila Nova de Cerveira e Lovelhe"]
        
},
" Vila Real": { "Alijó": ["Alijó", "Favaios" , "Santa Eugénia", "Vila Verde"],    
        "Boticas": ["Beça","Boticas e Granja","Codessoso, Curros e Fiães do Tâmega","Vilar e Viveiro"],
        "Chaves": ["Calvão e Soutelinho da Raia","Loivos e Póvoa de Agrações","Oura","Santo António de Monforte"],
        "Mesão Frio": ["Mesão Frio","Vila Marim"],
        "Mondim de Basto": ["Atei","Bilhó","Campanhó e Paradança","Vilar de Ferreiros"],
        "Montalegre": ["Ferral","Negrões","Santo André","Vilar de Perdizes e Meixide"],
        "Murça": ["Candedo","Jou","Noura e Palheiros","Valongo de Milhais"],
        "Peso da Régua": ["Fontelas","Moura Morta e Vinhós","Poiares e Canelas","Vilarinho dos Freires"],
        "Ribeira de Pena": ["Alvadia","Cerva e Limões","Ribeira de Pena e Santo Aleixo de Além-Tâmega","Santa Marinha"],
        "Sabrosa": ["Covas do Douro","Provesende, Gouvães do Douro e São Cristóvão do Douro","Souto Maior","Vilarinho de São Romão"],
        "Santa Marta de Penaguião": ["Fontes","Lobrigos (São Miguel e São João Baptista) e Sanhoane","Medrões","Sever"],
        "Valpaços": ["Água Revés e Crasto","Lebução, Fiães e Nozelos","Tinhela e Alvarelhos","Vilarandelo"],
        "Vila Pouca de Aguiar": ["Bornes de Aguiar","Pensalvos e Parada de Monteiros","Telões","Vreia de Jales"],
        "Vila Real": ["Adoufe e Vilarinho de Samardã","Borbela e Lamas de Olo","Mouçós e Lamares","São Tomé do Castelo e Justes"]

},
" Viseu": { "Armamar": ["Aricera e Goujoim", "Santa Cruz" , "São Romão e Santiago", "Vila Seca e Santo Adrião"],    
        "Carregal do Sal": ["Beijós","Carregal do Sal","Oliveira do Conde","Parada"],
        "Castro Daire": ["Castro Daire","Mamouros, Alva e Ribolhos","Parada de Ester e Ester","São Joaninho"],
        "Cinfães": ["Alhões, Bustelo, Gralheira e Ramires","Ferreiros de Tendais","Oliveira do Douro","Tarouquela"],
        "Lamego": ["Cambres","Lamego","Parada do Bispo e Valdigem","Vila Nova de Souto d'El-Rei"],
        "Mangualde": ["Abrunhosa-a-Velha","Freixiosa","Santiago de Cassurrães e Póvoa de Cervães","Tavares"],
        "Moimenta da Beira": ["Arcozelos","Moimenta da Beira","Pêra Velha, Aldeia de Nacomba e Ariz","Vilar"],
        "Mortágua": ["Espinho","Mortágua, Vale de Remígio, Cortegaça e Almaça","Pala","Trezói"],
        "Nelas": ["Canas de Senhorim","Nelas","Senhorim","Vilar Seco"],
        "Oliveira de Frades": ["Arca e Varzielas","Oliveira de Frades, Souto de Lafões e Sejães","Ribeiradio","São Vicente de Lafões"],
        "Penalva do Castelo": ["Esmolfe","Lusinde","Trancozelos","Vila Cova do Covelo e Mareco"],
        "Penedono": ["Antas e Ourozinho","Penedono e Granja","Póvoa de Penela","Souto"],
        "Resende": ["Anreade e São Romão de Aregos","Felgueiras e Feirão","Ovadas e Panchorra","Resende"],
        "Santa Comba Dão": ["Pinheiro de Ázere","São Joaninho","São João de Areias","Treixedo e Nagozela"],
        "São João da Pesqueira": ["Castanheiro do Sul","Paredes da Beira","São João da Pesqueira e Várzea de Trevões","Vilarouco e Pereiros"],
        "São Pedro do Sul": ["Carvalhais e Candal","Pindelo dos Milagres","Santa Cruz da Trapa e São Cristóvão de Lafões","Vila Maior"],
        "Sátão": ["Águas Boas e Forles","Ferreira de Aves","Rio de Moinhos","São Miguel de Vila Boa"],
        "Sernancelhe": ["Chosendo","Ferreirim e Macieira","Granjal","Vila da Ponte"],
        "Tabuaço": ["Chavães","Paradela e Granjinha","Pinheiros e Vale de Figueira","Tabuaço"],
        "Tarouca": ["Granja Nova e Vila Chã da Beira","Salzedas","São João de Tarouca","Várzea da Serra"],
        "Tondela": ["Castelões","Lobão da Beira","Tonda","Tondela"],
        "Vila Nova de Paiva": ["Pendilhe","Queiriga","Vila Cova à Coelheira","Vila Nova de Paiva, Alhais e Fráguas"],
        "Viseu": ["Calde","Fail e Vila Chã de Sá","Orgens","Viseu"],
        "Vouzela": ["Cambra e Carvalhal de Vermilhas","Fornelo do Monte","Queirã","Vouzela e Paços de Vilharigues"]
}       






    
}
window.onload = function () {
var distrito = document.getElementById("distrito"),
concelho = document.getElementById("concelho"),
freguesia = document.getElementById("freguesia");
for (var distrit in stateObject) {
distrito.options[distrito.options.length] = new Option(distrit, distrit);
}
distrito.onchange = function () {
concelho.length = 1; // remove all options bar first
freguesia.length = 1; // remove all options bar first
if (this.selectedIndex < 1) return; // done 
for (var state in stateObject[this.value]) {
concelho.options[concelho.options.length] = new Option(state, state);
}
}
distrito.onchange(); // reset in case page is reloaded
concelho.onchange = function () {
freguesia.length = 1; // remove all options bar first
if (this.selectedIndex < 1) return; // done 
var district = stateObject[distrito.value][this.value];
for (var i = 0; i < district.length; i++) {
freguesia.options[freguesia.options.length] = new Option(district[i], district[i]);
}
}
}