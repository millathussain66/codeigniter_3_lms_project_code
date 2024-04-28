<?xml version="1.0" encoding="UTF-8"?>
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"><soapenv:Body><ns2:loanListAndDetailsResp xmlns:ns2="http://bracbank.com/UBALoanListAndDetailsES/V1"><ns2:fetchLoanListAndDetailsRespDetail><ns2:header><ns3:serviceId xmlns:ns3="http://bracbank.com/utilityCommon/V1">UC-019</ns3:serviceId><ns3:serviceName xmlns:ns3="http://bracbank.com/utilityCommon/V1">UBALoanListAndDetailsES</ns3:serviceName><ns3:sourceTimestamp xmlns:ns3="http://bracbank.com/utilityCommon/V1">2008-09-29T07:49:45</ns3:sourceTimestamp><ns3:password xmlns:ns3="http://bracbank.com/utilityCommon/V1">Ahj67#12i89kT!z</ns3:password><ns3:channelName xmlns:ns3="http://bracbank.com/utilityCommon/V1">LMS</ns3:channelName><ns3:channelCode xmlns:ns3="http://bracbank.com/utilityCommon/V1">LMS</ns3:channelCode><ns3:globalTransactionId xmlns:ns3="http://bracbank.com/utilityCommon/V1">Req_1456378980963</ns3:globalTransactionId></ns2:header><ns2:errorCode>000</ns2:errorCode><ns2:errorMessage>Success</ns2:errorMessage><ns2:loanAccountDetails><ns2:loanAccountDetail><ns2:accountNumber>1501603079789004</ns2:accountNumber><ns2:accountCurrency>BDT</ns2:accountCurrency><ns2:accountHolderName>MD. GOLAM RABBANY</ns2:accountHolderName><!--20-Sept-2020 : loanStatus mapping Change from Finacle for UU-224, UU-364, UU-352 , UU-290 , UU-289 --><!--18-Feb-2021 :FSD0.6 --><!--ns2:loanStatus>{$FinacleResp/ns1:Body/ns1:executeFinacleScriptResponse/ns1:executeFinacleScript_CustomData/ns1:instDetail/ns1:loanOverDueStatus/text()}</ns2:loanStatus--><ns2:loanStatus>R</ns2:loanStatus><ns2:overdueAmount>0.00</ns2:overdueAmount><!--20-Sept-2020 : new field loanDueAmount Change from Finacle for UU-161, UU-219, UU-363 --><!--ns2:loanDueAmount>{$FinacleResp/ns1:Body/ns1:executeFinacleScriptResponse/ns1:executeFinacleScript_CustomData/ns1:instDetail/ns1:DueAmount/text()}</ns2:loanDueAmount--><!--18-Feb-2021 :FSD0.6 --><ns2:schemeType>LAA</ns2:schemeType><ns2:schemeCode>TRSAM</ns2:schemeCode><ns2:loanBalance>732202.26</ns2:loanBalance><ns2:nextPaymentDate>2021-09-25T00:00:00.000</ns2:nextPaymentDate><ns2:loanInterestRate>9.000000</ns2:loanInterestRate><ns2:remainingInterestAmount>0</ns2:remainingInterestAmount><ns2:numberOfTotalInstallments>60</ns2:numberOfTotalInstallments><ns2:numberOfSettledInstallments>13</ns2:numberOfSettledInstallments><ns2:numberOfRemainingInstallments>47</ns2:numberOfRemainingInstallments><!--21-Sept-2020 : firstInstallmentDate mapping Change from Finacle initInstallmentDate instead of firstInstallmentDate for UU-303, UU-318--><ns2:firstInstallmentDate>2020-08-25T00:00:00.000</ns2:firstInstallmentDate><ns2:lastInstallmentDate>2025-07-25T00:00:00.000</ns2:lastInstallmentDate><ns2:paymentFrequency>M</ns2:paymentFrequency><ns2:loanOpeningDate>2020-08-17T00:00:00.000</ns2:loanOpeningDate><ns2:installmentAmount>18683.00</ns2:installmentAmount><ns2:loanInterestReviewDate>2099-12-31T00:00:00.000</ns2:loanInterestReviewDate><!--18-Feb-2021 :FSD0.6 --><ns2:nextRenewalDate/><!--18-Feb-2021 :FSD0.6 --><ns2:totalLimit>900000.00</ns2:totalLimit><!--18-Feb-2021 :FSD0.6 --><ns2:availableBalance/><!--ns2:totalLimit>{$FinacleResp/ns1:Body/ns1:executeFinacleScriptResponse/ns1:executeFinacleScript_CustomData/ns1:genDetail/ns1:totLimit/text()}</ns2:totalLimit--><ns2:tenureDays>0</ns2:tenureDays><ns2:tenureMonths>60</ns2:tenureMonths><ns2:limitValue>900000.00</ns2:limitValue><ns2:oustandingAmount>732202.26</ns2:oustandingAmount><!--20-Sept-2020 : startDate mapping Change from Finacle for UU-224, UU-364, UU-352 , UU-290 , UU-289 --><!--18-Feb-2021 :FSD0.6 --><ns2:startDate/><!--18-Feb-2021 :FSD0.6 --><ns2:expiryDate/><ns2:linkAccount>1501103079789001</ns2:linkAccount><ns2:productDescription>PERSONAL LOAN - SALARIED</ns2:productDescription><ns2:collateral>0.00</ns2:collateral></ns2:loanAccountDetail></ns2:loanAccountDetails></ns2:fetchLoanListAndDetailsRespDetail></ns2:loanListAndDetailsResp></soapenv:Body></soapenv:Envelope>

