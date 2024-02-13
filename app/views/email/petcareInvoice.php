<html>

<body style="background-color:#e2e1e0;font-family: 'Poppins', sans-serif;font-size:100%;font-weight:400;line-height:1.4;color:#000;">
  <table style="max-width:670px;margin:50px auto 10px;background-color:#fff;padding:50px;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;-webkit-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);-moz-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24); border-top: solid 10px green;">
    <thead>
      <tr>
        <th style="text-align:left; font-size:40px;"><img style="max-width: 80px;" src="https://i.ibb.co/wQncy57/logo-croped.png" alt="PetCare-Logo"> PetCare</th>
        <th style="text-align:right;font-weight:400;">{order-date}</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style="height:35px;"></td>
      </tr>
      <tr>
        <td  colspan="2" style="border: solid 1px #ddd; padding:10px 20px;">
          <p style="font-size:14px;margin:0 0 6px 0;"><span style="font-weight:bold;display:inline-block;min-width:150px">Order status</span><b style="color:green;font-weight:normal;margin:0">Success</b></p>
          <p style="font-size:14px;margin:0 0 6px 0;"><span style="font-weight:bold;display:inline-block;min-width:146px">Invoice ID</span> {invoice-id}</p>
          <p style="font-size:14px;margin:0 0 0 0;"><span style="font-weight:bold;display:inline-block;min-width:146px">Order amount</span>LKR {total}</p>
        </td>
      </tr>
      <tr>
        <td style="height:35px;"></td>
      </tr>
      <tr bgcolor="#F5F8FA">
        <td style="width:50%;padding:20px;vertical-align:top">
          <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px">Name</span> {fname} {lname}</p>
          <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Email</span> {email}</p>

        </td>
        <td style="width:50%;padding:20px;vertical-align:top">
          <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Address</span>{address}</p>
                    <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Phone</span>{phone}</p>
        </td>
      </tr>
      <tr>
        <td colspan="2" style="font-size:20px;padding:30px 15px 0 15px;">Product Items</td>
      </tr>
      <tr>
        <td colspan="2" style="padding:15px;">
          {products} 
        </td>
      </tr>
    </tbody>
    <tfooter >
      <tr bgcolor="#EAF0F6">
            <td colspan="2" align="center" style="padding: 30px 30px;">
                <h2>Thank You for Choosing PetCare &hearts;</h2>
                <p> We appreciate your decision to trust PetCare for your pets well-being. Our commitment is to provide exceptional care and service. </p>
                <a href="http://localhost/petcare/home">Visit Our Site</a>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center" style="padding: 30px 30px;">
                <p style="color:#99ACC2"> &copy; 2023-present PetCare. All rights reserved. </p>
                <!--  <a class="subtle-link" href="#"> Unsubscribe </a>      -->
            </td>
        </tr>
    </tfooter>
  </table>
</body>

</html>