






@var $email = isset($xml['GetCustomerAssetsSuccess']['Asset']['TrueLinkCreditReport']['Borrower']['EmailAddress']['Email'])?$xml['GetCustomerAssetsSuccess']['Asset']['TrueLinkCreditReport']['Borrower']['EmailAddress']['Email']:'';   
@var $allAddress = $xml['GetCustomerAssetsSuccess']['Asset']['TrueLinkCreditReport']['Borrower']['BorrowerAddress'];
@var $panNo = $xml['GetCustomerAssetsSuccess']['Asset']['TrueLinkCreditReport']['Borrower']['IdentifierPartition']['Identifier']['1']['ID']['Id'];
@var $identifire = $xml['GetCustomerAssetsSuccess']['Asset']['TrueLinkCreditReport']['Borrower']['IdentifierPartition']['Identifier']['1']['ID']['IdentifierName'];
@var $identifireIssuDate = !empty($xml['GetCustomerAssetsSuccess']['Asset']['TrueLinkCreditReport']['Borrower']['IdentifierPartition']['Identifier']['1']['ID']['IssueDate'])?$xml['GetCustomerAssetsSuccess']['Asset']['TrueLinkCreditReport']['Borrower']['IdentifierPartition']['Identifier']['1']['ID']['IssueDate']:'-';
@var $identifireExpairyDate = !empty($xml['GetCustomerAssetsSuccess']['Asset']['TrueLinkCreditReport']['Borrower']['IdentifierPartition']['Identifier']['1']['ID']['ExpirationDate'])?$xml['GetCustomerAssetsSuccess']['Asset']['TrueLinkCreditReport']['Borrower']['IdentifierPartition']['Identifier']['1']['ID']['ExpirationDate']:'-';
@var $gender = $xml['GetCustomerAssetsSuccess']['Asset']['TrueLinkCreditReport']['Borrower']['Gender'];
@var $ddobs = isset($xml['GetCustomerAssetsSuccess']['Asset']['TrueLinkCreditReport']['Borrower']['Birth']['@attributes']['date'])?$xml['GetCustomerAssetsSuccess']['Asset']['TrueLinkCreditReport']['Borrower']['Birth']['@attributes']['date']:'';
@if($ddobs != '')
$ddobs = explode('+',$ddobs);
@var $dob =date("d-m-Y", strtotime( $ddobs[0]));
@else
$dob = '-';
@endif

@var $addCategory = array('01' => 'Permanent Address', '02' => 'Residence Address', '03' => 'Office Address', '04' => 'Not Categorized');
@var $customerName = $xml['GetCustomerAssetsSuccess']['Asset']['TrueLinkCreditReport']['Borrower']['BorrowerName']['Name']['Forename']; 
@var $creditScore = $xml['GetCustomerAssetsSuccess']['Asset']['TrueLinkCreditReport']['Borrower']['CreditScore']['@attributes']['riskScore'];
@var $employer = $xml['GetCustomerAssetsSuccess']['Asset']['TrueLinkCreditReport']['Borrower']['Employer'];
@var $inquary = $xml['GetCustomerAssetsSuccess']['Asset']['TrueLinkCreditReport']['InquiryPartition'];  

@var $banklist = $xml['GetCustomerAssetsSuccess']['Asset']['TrueLinkCreditReport']['TradeLinePartition']; 
@var $arr = ['TaxId' => 'INCOME TAX ID NUMBER (PAN)','PassportId' => 'Passport Number','VoterId' => 'Voter ID Number','DriversLicenseId' => 'Drivers License Number','RationCardId' => 'Ration Card Number','UniversalId' => '(This will no longer be returned) Universal ID Number (UID)','SocialId' => '(Do not display to consumer) Internal CIBIL Bureau FID'];
@var $wilful = ['00' => 'Restructured Loan','01' => 'Restructured Loan (Govt. Mandated)','02' => 'Written-off','03' => 'Settled','04' => 'Post (WO) Settled','05' => 'Account Sold','06' => 'Written Off and Account Sold','07' => 'Account Purchased','08' => 'Account Purchased and Written Off','09' => 'Account Purchased and Settled','10' => 'Account Purchased and Restructured','11' => 'Restructured due to Natural Calamity'];
@var $secondwilful = ['00' => 'No Suit Filed', '01' => 'Suit filed','02' => 'Wilful default','03' => 'Suit filed (Wilful default)'];
@var $controllno = $xml['GetCustomerAssetsSuccess']['Asset']['TrueLinkCreditReport']['ReferenceKey'];

@var $dispute = isset($xml['GetCustomerAssetsSuccess']['Asset']['TrueLinkCreditReport']['Borrower']['CreditStatement']['@attributes']['statement'])?$xml['GetCustomerAssetsSuccess']['Asset']['TrueLinkCreditReport']['Borrower']['CreditStatement']['@attributes']['statement']:'';
@var $enquirydis =  isset($xml['GetCustomerAssetsSuccess']['Asset']['TrueLinkCreditReport']['Borrower']['BorrowerName']['DisputeRemarks']['remarksCode']['@attributes']['symbol']) && !empty($xml['GetCustomerAssetsSuccess']['Asset']['TrueLinkCreditReport']['Borrower']['BorrowerName']['DisputeRemarks']['remarksCode']['@attributes']['symbol'])?$xml['GetCustomerAssetsSuccess']['Asset']['TrueLinkCreditReport']['Borrower']['BorrowerName']['DisputeRemarks']['remarksCode']['@attributes']['symbol']:'';
@if( $dispute != '')
    @var $disputesdate = isset($xml['GetCustomerAssetsSuccess']['Asset']['TrueLinkCreditReport']['Borrower']['CreditStatement']['@attributes']['dateUpdated'])?$xml['GetCustomerAssetsSuccess']['Asset']['TrueLinkCreditReport']['Borrower']['CreditStatement']['@attributes']['dateUpdated']:'';
   @var $exp =  explode('|',$dispute);
    @var $memberName = $exp[0];
    @var $accountNo = $exp[1];
    @var $disputeremark = $exp[2];
 @else
    @var $memberName = '-';
    @var $accountNo = '-';
    @var $disputeremark = '-';
@endif

@var $enguiryType = ['01'=>'Auto Loan (Personal)', '02'=>'Housing Loan', '03'=>'Property Loan', '04'=>'Loan Against Shares/Securities','05'=>'Personal Loan','06'=>'Consumer Loan', '07'=>'Gold Loan', '08'=>'Education Loan', '09'=>'Loan to Professional', '10'=>'Credit Card','11'=>'Leasing', '12'=>'Overdraft', '13'=>'Two-wheeler Loan', '14'=>'(NFCF) Non-Funded Credit Facility', '15'=>'(LABD) Current Loan Against Bank Deposits','16'=>'Fleet Card', '17'=>'Commercial Vehicle Loan', '18'=>'Telco – Wireless', '19'=>'Telco – Broadband', '20'=>'Telco – Landline','31'=>'Secured Credit Card', '32'=>'Used Car Loan', '33'=>'Construction Equipment Loan', '34'=>'Tractor Loan','35'=>'Corporate Credit Card', '36'=>'Kisan Credit Card', '37'=>'Loan on Credit Card', '38'=>'Prime Minister Jaan Dhan Yojana-Overdraft','39'=>'Mudra Loans – Shishu / Kishor / Tarun', '40'=>'Microfinance – Business Loan', '41'=>'Microfinance – Personal Loan','42'=>'Microfinance – Housing Loan', '43'=>'Microfinance – Other', '44'=>'Pradhan Mantri Awas Yojana-Credit Link Subsidy Scheme MAY CLSS','50'=>'Business Loan-Secured', '51'=>'Business Loan – General', '52'=>'(BLPS-SB) Business Loan – Priority Sector – Small Business','53'=>'(BLPS-AGR) Business Loan – Priority Sector – Agriculture','54'=>'(BLPS-OTH) Business Loan – Priority Sector – Others','55'=>' (BNFCF-GEN) Business Non-Funded Credit Facility – General','56'=>'(BNFCF-PS-SB) Business Non-Funded Credit Facility – Priority Sector – Small Business','57'=>'(BNFCF-PS-AGR)  Business Non-Funded Credit Facility – Priority Sector – Agriculture','58'=>'(BNFCF-PS-OTH)  Business Non-Funded Credit Facility – Priority Sector-Others','59'=>'(BLABD) Current Business Loan Against Bank Deposits','61'=>'Business Loan-Unsecured','80'=>'Microfinance Detailed Report (Applicable to Enquiry Purpose only)','81'=>'Summary Report (Applicable to Enquiry Purpose only)','88'=>'Locate Plus for Insurance (Applicable to Enquiry Purpose only)','90'=>'Account Review (Applicable to Enquiry Purpose only)','91'=>'Retro Enquiry (Applicable to Enquiry Purpose only)','92'=>'Locate Plus (Applicable to Enquiry Purpose only)','97'=>'Adviser Liability (Applicable to Enquiry Purpose only)','98'=>'Secured (Account Group for Portfolio Review response)','99'=>'Unsecured (Account Group for Portfolio Review response)','00'=>'Other']
@var $ww = ['01' =>'Weekly','02' =>'Fortnightly', '03' =>'Monthly','04' =>'Quarterly']
@var = $avb['1'	=> 'Individual','2'	=> 'Authorized User','3' => 'Guarantor','4' => 'Joint'] 



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700,800" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="{{ asset('/css/cibil_pdf/custom_bootstrap.css') }}" />
   <link rel="stylesheet" type="text/css" href="{{ asset('/css/cibil_pdf/pdf.css') }}" />
</head>

<body>
    <div class="container-fluid mainContainer bdr pt-20">
        <header>
            <div class="row d-flex align-items-center">
                <div class="col-xs-2">
                <img src="{{ asset('images/cibil_image/logo.png') }}" />
                </div>
                <div class="col-xs-3 col-xs-offset-2">
             <img src="{{ asset('images/cibil_image/andromeda-logo.png') }}" />
                </div>
                <div class="col-xs-5 text-right font-size-20 font-weight-bold">
                    <span>CIBIL CREDIT REPORT</span>
                </div>
            </div>
            <div class="row d-flex align-items-flex-end mlr-10 border-bottom-1">
                <div class="col-xs-8">
                    <b>DATE</b>: {{date("d-m-Y")}}
                </div>
                <div class="col-xs-4 text-right pr-0">
                    <div class="reportInfo">
                        <p>CONTROL NUMBER: {{$controllno}}</p>
                        @if($disputeremark != '-')
                            <p class="redSquare">
                                {{$disputeremark}}
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </header>
        <main>
            <div class="row">
                <div class="col-xs-12">
                    <h1 class="ml-0">CIBIL SCORE</h1>
                </div>
            </div>
            <div class="row d-flex align-items-flex-end">
                <div class="col-xs-4 ml-20">
                    <div class="w3-light-grey">
                        @var $per = $creditScore/10
                        <div class="w3-container w3-blue w3-center" style="width:{{$per}}%">{{$creditScore}}</div>
                    </div>
                </div>
                <div class="col-xs-8">
                    <p class="circle blueCircle">Your Score</p>
                      </div>
            </div>
            <div class="mt-20 pt-0">
                <div class="row">
                    <div class="col-xs-12">
                        <h1 class="mt-0">PERSONAL INFORMATION</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <table class="rwd-table border-bottom-last-child-tr-0">
                            
                                <tr>
                                    <td width="40%"></td>
                                    <td width="20%"></td>
                                    <td width="20%"></td>
                                    <td width="20%"></td>
                                </tr>
                            
                            
                                <tr>
                                    <td colspan="4">
                                        <table class="rwd-table text-center">
                                            
                                                <tr class="noBorderBottom">
                                                    <td width="33.33%" data-th="NAME">
                                                        <span>{{$customerName}}</span>
                                                    </td>
                                                    <td width="33.33%" data-th="DATE OF BIRTH">
                                                        <span>{{$dob}}</span>
                                                    </td>
                                                    <td width="33.33%" data-th="GENDER">
                                                        <span>{{$gender}}</span>
                                                    </td>
                                                </tr>
                                            
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                   
                                    <td data-th="IDENTIFICATION TYPE">{{$arr[$identifire]}}</td>
                                    <td data-th="NUMBER">
                                        <span>{{$panNo}}</span>
                                    </td>
                                    <td data-th="ISSUE DATE">
                                        <span>{{$identifireIssuDate}}</span>
                                    </td>
                                    <td data-th="EXPIRATION DATE">
                                        <span>{{$identifireExpairyDate}}</span>
                                    </td>
                                </tr>
                            
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <h1>CONTACT INFORMATION </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <table class="rwd-table">
                            
                                <tr>
                                    <td width="40%"></td>
                                    <td width="20%"></td>
                                    <td width="20%"></td>
                                    <td width="20%"></td>
                                </tr>
                            
                            
                              @for($i = 0;$i<count($allAddress);$i++) 
                                 
                                  <tr>
                                    <td data-th="ADDRESS {{$i+1}}">
                                        <span>{{$allAddress[$i]['CreditAddress']['StreetAddress']}}</span>
                                    </td>
                                    <td data-th="CATEGORY">
                                        <span>   
                                            {{!isset($allAddress[$i]['Dwelling']['@attributes']['symbol'])?$addCategory[$allAddress[$i]['Dwelling']['@attributes']['symbol']]:'NOT CATEGORIZED'}}
                                        </span>
                                    </td>
                                    <td data-th="STATUS">
                                        <span> {{!isset($allAddress[$i]['Ownership']['@attributes']['description'])?$allAddress[$i]['Ownership']['@attributes']['description']:'-'}}</span>
                                    </td>
                                    <td data-th="DATE REPORTED">
                                        <span>
                                            @var $tt = isset($allAddress[$i]['@attributes']['dateReported'])?$allAddress[$i]['@attributes']['dateReported']:'';
                                            @if($tt != '')
                                            @var $tt = explode('+', $tt)
                                             {{date("d-m-Y", strtotime($tt[0]))}}
                                             @else
                                             -
                                            @endif 
                                        
                                        </span>
                                    </td>
                                </tr>
                                @endfor
                                <tr>
                                    <td data-th="EMAIL CONTACT">
                                        <span>EMAIL ADDRESS1:</span>
                                    </td>
                                    <td data-th="">
                                        <span>{{$email}}</span>
                                    </td>
                                </tr>
                                @if($enquirydis != '')
                                <tr>
                                    <td class="font-color-red font-weight-bold" colspan="4">
                                        <span>{{$enquirydis}}</span>
                                    </td>
                                </tr>
                                @endif
                                @if($disputeremark != '-')
                                <tr>
                                    <td class="font-color-red " colspan="3">
                                        <span>{{$disputeremark}}</span>
                                    </td>
                                    <td class="font-color-red">DISPUTE DATE:, {{$disputesdate}}</td>
                                </tr>
                                @endif
                            
                        </table>
                    </div>
                </div>
            </div>
            <!-- Start of Employment Information -->
            <div class="row">
                <div class="col-xs-12">
                    <h1 class="ml-0">EMPLOYMENT INFORMATION</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <table class="rwd-table border-bottom-last-child-tr-0">
                        
                            <tr>
                                <td width="33.33%"></td>
                                <td width="33.33%"></td>
                                <td width="33.33%"></td>
                            </tr>
                        
                        
                            <tr>
                                <td data-th="ACCOUNT TYPE">
                                    <span>{{isset($employer['@attributes']['name'])?$employer['@attributes']['name']:'-'}}</span>

                                </td>
                               <td data-th="DATE REPORTED">
                                    <span>{{isset($employer['@attributes']['dateReported'])?date("d-m-Y", strtotime( explode('+', $employer['@attributes']['dateReported'])[0])):'-'}}</span>
                                </td>
                                <td data-th="OCCUPATION">
                                    <span>{{isset($employer['OccupationCode']['@attributes']['description'])?$employer['OccupationCode']['@attributes']['description']:'-'}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td data-th="INCOME">
                                    <span>{{isset($employer['@attributes']['income'])?$employer['@attributes']['income']:'-'}}</span>
                                </td>
                                <td data-th="FREQUENCY">
                                    <span>{{isset($employer['IncomeFreqIndicator']['@attributes']['description'])?$employer['IncomeFreqIndicator']['@attributes']['description']:'-'}}</span>
                                </td>
                                <td data-th="INCOME INDICATOR">
                                    <span>{{isset($employer['NetGrossIndicator']['@attributes']['description'])?$employer['NetGrossIndicator']['@attributes']['description']:'-'}}</span>
                                </td>
                            </tr>
                        
                    </table>
                </div>
            </div>
            <!-- End of Employment Information -->
            <!-- Start of Account Information -->
            <div class="row">
                <div class="col-xs-12">
                    <h1 class="ml-0">ACCOUNT INFORMATION</h1>
                </div>
            </div>
           
            @for($k=0;$k<count($banklist);$k++)
            <div class="row">
                <div class="col-xs-12">
                    <table class="rwd-table border-bottom-last-child-tr-0 theadBdYellow accountInfo">
                        
                            <tr class = "bgYellow">
                                <th width="25%">{{isset($banklist[$k]['Tradeline']['@attributes']['creditorName'])?$banklist[$k]['Tradeline']['@attributes']['creditorName']:'-'}}</th>
                                <th width="25%">{{isset($banklist[$k]['Tradeline']['GrantedTrade']['AccountType']['description'])?$banklist[$k]['Tradeline']['GrantedTrade']['AccountType']['description']:'-'}}</th>
                                <th width="25%">{{isset($banklist[$k]['Tradeline']['@attributes']['accountNumber'])?$banklist[$k]['Tradeline']['@attributes']['accountNumber']:'-'}}</th>
                                <th width="25%">{{isset($banklist[$k]['Tradeline']['AccountDesignator']['@attributes']['abbreviation'])?$avb[$banklist[$k]['Tradeline']['AccountDesignator']['@attributes']['abbreviation']]:'-'}}</th>
                            </tr>
                        
                        
                            <tr class="font-color-laser">
                                <td class="noLabel">(MEMBER NAME)</td>
                                <td class="noLabel">(ACCOUNT TYPE)</td>
                                <td class="noLabel">(ACCOUNT NUMBER)</td>
                                <td class="noLabel">(OWNERSHIP)</td>
                            </tr>
                            <tr class="noBorderBottom">
                                <td data-th="ACCOUNT DETAILS">
                                    <span>CREDIT LIMIT</span>
                                </td>
                                <td data-th="">
                                    <span>
                                        @if(isset($banklist[$k]['Tradeline']['GrantedTrade']['CreditLimit']))
                                            @if($banklist[$k]['Tradeline']['GrantedTrade']['CreditLimit'] == 0)
                                                -
                                                @else
                                                {{$banklist[$k]['Tradeline']['GrantedTrade']['CreditLimit']}}
                                            @endif    
                                            
                                        @else
                                        -
                                        @endif
                                        
                                        
                                       </span>
                                </td>
                                <td data-th="">
                                    <span>RATE OF INTEREST</span>
                                </td>
                                <td data-th="">
                                    <span>{{isset($banklist[$k]['Tradeline']['GrantedTrade']['@attributes']['interestRate'])?$banklist[$k]['Tradeline']['GrantedTrade']['@attributes']['interestRate']:'-' }}</span>
                                </td>
                            </tr>
                            <tr class="noBorderBottom">
                                <td class="noLabel">
                                    <span> SANCTIONED AMOUNT</span>
                                </td>
                                <td class="noLabel">
                                    <span>{{isset($banklist[$k]['Tradeline']['@attributes']['highBalance'])?$banklist[$k]['Tradeline']['@attributes']['highBalance']:'-'}}</span>
                                </td>
                                <td class="noLabel">
                                    <span>REPAYMENT TENURE</span>
                                </td>
                                <td class="noLabel">
                                    <span>{{isset($banklist[$k]['Tradeline']['GrantedTrade']['@attributes']['termMonths'])?$banklist[$k]['Tradeline']['GrantedTrade']['@attributes']['termMonths']:'-' }}</span>
                                </td>
                            </tr>
                            <tr class="noBorderBottom">
                                <td class="noLabel">
                                    <span> CURRENT BALANCE</span>
                                </td>
                                <td class="noLabel">
                                    <span>{{isset($banklist[$k]['Tradeline']['@attributes']['currentBalance'])?$banklist[$k]['Tradeline']['@attributes']['currentBalance']:'-'}}</span>
                                </td>
                                <td class="noLabel">
                                    <span>EMI AMOUNT</span>
                                </td>
                                <td class="noLabel">
                                    <span>{{isset($banklist[$k]['Tradeline']['GrantedTrade']['EMIAmount'])?$banklist[$k]['Tradeline']['GrantedTrade']['EMIAmount']:'-' }}</span>
                                </td>
                            </tr>
                            <tr class="noBorderBottom">
                                <td class="noLabel">
                                    <span>CASH LIMIT</span>
                                </td>
                                <td class="noLabel">
                                    <span>{{isset($banklist[$k]['Tradeline']['GrantedTrade']['CashLimit'])?$banklist[$k]['Tradeline']['GrantedTrade']['CashLimit']:'-'}}</span>
                                </td>
                                <td class="noLabel">
                                    <span>PAYMENT FREQUENCY</span>
                                </td>
                                <td class="noLabel">
                                    <span>{{isset($banklist[$k]['Tradeline']['GrantedTrade']['PaymentFrequency']['abbreviation'])?$ww[$banklist[$k]['Tradeline']['GrantedTrade']['PaymentFrequency']['abbreviation']]:'-'}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="noLabel">
                                    <span>AMOUNT OVERDUE</span>
                                </td>
                                <td class="noLabel">
                                    <span>{{isset($banklist[$k]['Tradeline']['GrantedTrade']['@attributes']['amountPastDue'])?$banklist[$k]['Tradeline']['GrantedTrade']['@attributes']['amountPastDue']:'-' }}</span>
                                </td>
                                <td class="noLabel">
                                    <span>ACTUAL PAYMENT AMOUNT</span>
                                </td>
                                <td class="noLabel">
                                    <span>{{isset($banklist[$k]['Tradeline']['GrantedTrade']['actualPaymentAmount'])?$banklist[$k]['Tradeline']['GrantedTrade']['actualPaymentAmount']:'-'}}</span>
                                </td>
                            </tr>
                            
                            <tr class="noBorderBottom font-weight-bold">
                                <td colspan=" 4 ">DATES</td>
                            </tr>
                            <tr class="noBorderBottom">
                                <td class="noLabel">
                                    <span>DATE OPENED/DISBURSED</span>
                                </td>
								 <td>
                                    <span>{{isset($banklist[$k]['Tradeline']['@attributes']['dateOpened'])?date("d-m-Y", strtotime(explode('+', $banklist[$k]['Tradeline']['@attributes']['dateOpened'])[0])):'-'}}</span>
                                </td>
                                <td>
                                    <span>DATE OF LAST PAYMENT</span>
                                </td>
                                <td>
                                    @var $strdate = '-'
                                    @if(isset($banklist[$k]['Tradeline']['GrantedTrade']['dateLastPayment']))
                                            @var $dateeds =  explode('+',$banklist[$k]['Tradeline']['GrantedTrade']['dateLastPayment'])
                                            $strdate = date("d-m-Y", strtotime($dateeds[0]))    
                                    @endif
                                    
                                    <span>{{$strdate}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="noLabel">
                                    <span>DATE CLOSED</span>
                                </td>
                                <td class="noLabel">
                                    <span>{{isset($banklist[$k]['Tradeline']['@attributes']['dateClosed'])?date("d-m-Y", strtotime(explode('+',$banklist[$k]['Tradeline']['@attributes']['dateClosed'])[0])):'-'}}</span>
                                </td>
                                <td class="noLabel">
                                    <span>DATE REPORTED AND CERTIFIED</span>
                                </td>
                                <td class="noLabel">
                                    <span>{{isset($banklist[$k]['Tradeline']['@attributes']['dateReported'])?date("d-m-Y", strtotime(explode('+', $banklist[$k]['Tradeline']['@attributes']['dateReported'])[0])):'-'}}</span>
                                </td>
                            </tr>
                            <tr class="noBorderBottom font-weight-bold">
                                <td colspan=" 4 ">PAYMENT HISTORY (UP TO 36 MONTHS)</td>
                            </tr>
                            <tr class="noBorderBottom">
                                <td class="noLabel">
                                    <span>PAYMENT START DATE</span>
                                </td>
                                <td class="noLabel">
                                    <span>{{isset($banklist[$k]['Tradeline']['PayStatusHistory']['@attributes']['startDate'])?$banklist[$k]['Tradeline']['PayStatusHistory']['@attributes']['startDate']:'-'}}</span>
                                    </td>
                                    <td class="noLabel">
                                        <span>PAYMENT END DATE</span>
                                    </td>
                                    <td class="noLabel">
                                        <span>{{isset($banklist[$k]['Tradeline']['PayStatusHistory']['@attributes']['endDate'])?$banklist[$k]['Tradeline']['PayStatusHistory']['@attributes']['endDate']:'-'}}</span>
                                    </td>
                                </tr>
                            <tr>
                                <td>
                                    <span></span>
                                </td>
                                <td>
                                    <span>DD-MM-YYYY</span>
                                </td>
                                <td>
                                    <span></span>
                                </td>
                                <td>
                                    <span>DD-MM-YYYY</span>
                                </td>
                            </tr>
                            <tr class="noBorderBottom font-weight-bold">
                                <td colspan="4">DAYS PAST DUE (No.of Days) or ASSET CLASSIFICATION (STD, SMA, SUB, DBT, LSS)</td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <table class="rwd-table firstColumnLeftAlign tableBorder text-center">
                                        
                                            <tr>
                                                <th>YEAR/MONTH</th>
                                                <th>DEC</th>
                                                <th>NOV</th>
                                                <th>OCT</th>
                                                <th>SEP</th>
                                                <th>AUG</th>
                                                <th>JUL</th>
                                                <th>JUN</th>
                                                <th>MAY</th>
                                                <th>APR</th>
                                                <th>MAR</th>
                                                <th>FEB</th>
                                                <th>JAN</th>
                                            </tr>
                                            
                                                
                                               
                                                @var $subtable = !empty($banklist[$k]['Tradeline']['GrantedTrade']['PayStatusHistory']['MonthlyPayStatus']?$banklist[$k]['Tradeline']['GrantedTrade']['PayStatusHistory']['MonthlyPayStatus']:-1);
                                                @var $c= 0;
                                                @var $dpdArr= array();
                                                @for($l = 0; $l<count($subtable); $l++)
                                                    @if(!empty($subtable[$l]['@attributes']['date']))
                                                        @var $subtable[$l]['@attributes']['date']  = explode('+', $subtable[$l]['@attributes']['date']);
                                                        @var $Mydate = date("m-Y", strtotime($subtable[$l]['@attributes']['date'][0]));
                                                        @var $Mystatus = $subtable[$l]['@attributes']['status'];
                                                        @var $dexp = explode('-',$Mydate);
                                                        @var $myYear = $dexp[1];
                                                        @var $mymonth = $dexp[0];
                                                        @var $dpdArr[$myYear][$mymonth] = $Mystatus;
                                                    @endif    
                                                @endfor
                                                @if(count($dpdArr) == 0)
                                                    <tr>
                                                     <td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>
                                                    </tr>
                                                @else
                                                @foreach($dpdArr as $year=>$month)
                                                        
                                                    <tr>
                                                    <td class="pl-5">{{$year}}</td>
                                                    <td>
                                                        {{isset($month['12'])?$month['12']:''}}
                                                    </td>
                                                    <td>
                                                       {{isset($month['11'])?$month['11']:''}}
                                                    </td>
                                                    <td>
                                                       {{isset($month['10'])?$month['10']:''}}
                                                    </td>
                                                    <td>
                                                       {{isset($month['09'])?$month['09']:''}}
                                                    </td>
                                                    <td>
                                                       {{isset($month['08'])?$month['08']:''}}
                                                    </td>
                                                    <td>
                                                       {{isset($month['07'])?$month['07']:''}} 
                                                    </td>
                                                    <td>
                                                       {{isset($month['06'])?$month['06']:''}}
                                                    </td>
                                                    <td>
                                                       {{isset($month['05'])?$month['05']:''}}
                                                    </td>
                                                    <td>
                                                       {{isset($month['04'])?$month['04']:''}}
                                                    </td>
                                                    <td>
                                                        {{isset($month['03'])?$month['03']:''}}
                                                    </td>
                                                    <td>
                                                        {{isset($month['02'])?$month['02']:''}}
                                                    </td>
                                                    <td>
                                                        {{isset($month['01'])?$month['01']:''}}
                                                    </td>
                                                </tr>
                                                 @endforeach
                                                @endif 
                                        
                                    </table>
                                </td>
                            </tr>
                            <tr class="noBorderBottom">
                                <td data-th="COLLATERAL">
                                    <span>VALUE OF COLLATERAL</span>
                                </td>
                                <td data-th="">
                                    <span>{{isset($banklist[$k]['Tradeline']['GrantedTrade']['@attributes']['collateral'])?$banklist[$k]['Tradeline']['GrantedTrade']['@attributes']['collateral']:'-'}}</span>
                                </td>
                                <td data-th="DEFAULT STATUS">
                                    <span>
                                        @var $ff = $banklist[$k]['Tradeline']['AccountCondition']['@attributes']['abbreviation'];
                                        @if($ff != '' && $ff == 'writtenOffAndSettledStatus')
                                            WRITTEN-OFF STATUS
                                        @elseif($ff == 'suitFiledStatus')
                                            SUIT FILED/WILFUL DEFAULT
                                        @else
                                             SUIT FILED/WILFUL DEFAULT
                                        @endif     
                                        </span>
                                </td>
                                <td data-th="">
                                    <span>
                                        @var $symbol = $banklist[$k]['Tradeline']['AccountCondition']['@attributes']['symbol'];
                                        @if($ff != '' && $ff == 'writtenOffAndSettledStatus')
                                            {{$wilful[$symbol]}}
                                        @elseif($ff == 'suitFiledStatus')
                                            {{$secondwilful[$symbol]}}
                                        @else
                                            -
                                        @endif 
                                    </span>
                                </td>
                            </tr>
                            <tr class="noBorderBottom">
                                <td>
                                    <span>TYPE OF COLLATERAL</span>
                                </td>
                                <td colspan = '2'>
                                    <span>{{isset($banklist[$k]['Tradeline']['GrantedTrade']['CollateralType']['@attributes']['description'])?$banklist[$k]['Tradeline']['GrantedTrade']['CollateralType']['@attributes']['description']:'-'}}</span>
                                </td>
                                
                            </tr>
                            <tr class="noBorderBottom">
                                <td>
                                    <span></span>
                                </td>
                                <td>
                                    <span></span>
                                </td>
                                <td>
                                    <span>WRITTEN-OFF AMOUNT(TOTAL)</span>
                                </td>
                                <td>
                                    <span>{{isset($banklist[$k]['Tradeline']['writtenOffAmtTotal']['@attributes']['description'])?$banklist[$k]['Tradeline']['writtenOffAmtTotal']['@attributes']['description']:'-'}}</span>
                                </td>
                            </tr>
                            <tr class="noBorderBottom">
                                <td>
                                    <span></span>
                                </td>
                                <td>
                                    <span></span>
                                </td>
                                <td>
                                    <span>WRITTEN-OFF AMOUNT(PRINCIPAL)</span>
                                </td>
                                <td>
                                    <span>{{isset($banklist[$k]['Tradeline']['writtenOffAmtPrincipal']['@attributes']['description'])?$banklist[$k]['Tradeline']['writtenOffAmtPrincipal']['@attributes']['description']:'-'}}</span>
                                </td>
                            </tr>
                            <tr class="">
                                <td>
                                    <span></span>
                                </td>
                                <td>
                                    <span></span>
                                </td>
                                <td>
                                    <span>SETTLEMENT AMOUNT</span>
                                </td>
                                <td>
                                    <span>{{isset($banklist[$k]['Tradeline']['settlementAmount']['@attributes']['description'])?$banklist[$k]['Tradeline']['settlementAmount']['@attributes']['description']:'-'}}</span>
                                </td>
                            </tr>
                        
                    </table>
                </div>
            </div>
            
            @endfor
            
            
            <!-- End of Account Information -->
            <!-- Start of Enquiry Information -->
            <div class="row">
                <div class="col-xs-12">
                    <h1 class="ml-0">ENQUIRY INFORMATION</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <table class="rwd-table border-bottom-last-child-tr-0 firstColumnLeftAlign text-center">
                        
                            <tr>
                                <th width="25%">MEMBER NAME</th>
                                <th width="25%">DATE OF ENQUIRY</th>
                                <th width="25%">ENQUIRY PURPOSE</th>
                                <th width="25%">ENQUIRY AMOUNT</th>
                            </tr>
                        
                        
                            
                           @for($j = 0;$j<count($inquary);$j++) 
                           
                            <tr>
                                <td>
                                    <span>{{$inquary[$j]['Inquiry']['@attributes']['subscriberName']}}</span>

                                </td>
                                <td>
                                    <span>{{date("d-m-Y", strtotime(explode('+', $inquary[$j]['Inquiry']['@attributes']['inquiryDate'])[0]))}}</span>
                                </td>
                                <td>
                                    <span> {{(!empty($inquary[$j]['Inquiry']['@attributes']['inquiryType'])?$enguiryType[$inquary[$j]['Inquiry']['@attributes']['inquiryType']]:'OTHER')}}</span>
                                </td>
                                <td>
                                    <span>{{$inquary[$j]['Inquiry']['@attributes']['amount']}}</span>
                                </td>
                            </tr>
                             @endfor
                        
                    </table>
                </div>
            </div>
            <!-- End of Enquiry Information -->
            <!-- Start of CONSUMER DISPUTE REMARKS -->
            <div class="row">
                <div class="col-xs-12">
                    <h1 class="ml-0">CONSUMER DISPUTE REMARKS</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <table class="rwd-table firstColumnLeftAlign tableBorder text-center">
                        
                            <tr>
                                <th width="25%">MEMBER NAME</th>
                                <th width="25%">ACCOUNT NUMBER</th>
                                <th width="25%">DISPUTE REMARK</th>
                                <th width="25%">DISPUTE REMARKS REMOVAL DATE</th>
                            </tr>
                        
                        
                            <tr>
                                <td>
                                    <span>{{$memberName}}</span>

                                </td>
                                <td>
                                    <span>{{$accountNo}}</span>
                                </td>
                                <td>
                                    <span>{{$disputeremark}}</span>
                                </td>
                                <td>
                                    <span>-</span>
                                </td>
                            </tr>
                        
                    </table>
                </div>
            </div>
            <!-- End of CONSUMER DISPUTE REMARKS -->
            <h2>END OF CREDIT INFORMATION REPORT FOR {{$customerName}}</h2>
            <p class="font-style-italic">All information contained in this credit report has been collated by TransUnion CIBIL Limited (Formerly: Credit
                Information Bureau (India) Limited) (CIBIL) based on information provided by its various members("Members").
                Consequently, CIBIL does not accept any responsibility on accuracy, completeness, and veracity of any and
                all such information as provided. The information is current and up to date to such extent as provided by
                its members.Any information contained herein does not reflect the views of CIBIL or its directors or employees.
                The use of this report is governed by the terms and conditions of the Operating Rules for CIBIL and its Members.
            </p>

        </main>
        <footer>
            <div class="row ">
                <div class="col-xs-12 info ">
                    You now have access to CIBIL Marketplace! Now apply for Loan and Credit Cards (basis your credit eligibility) from participating
                    banks.
                </div>
            </div>
            </footer>
    </div>
</body>

</html>