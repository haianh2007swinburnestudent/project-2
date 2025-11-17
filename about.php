<?php include 'header.inc'; ?>
<?php include 'nav.inc'; ?>
  
<main id="about">
      <h1>About SoftDevs</h1>

      <p>
        SoftDevs is a global tech company, able to deliver demanding software products and services to customers
      </p>

      <div>

      
          <h2>Group Name, Class Time and Student IDs</h2>
            <p><strong>Group name:</strong> SoftDevs Team</p>
            <p><strong>Class time and day:</strong> Friday 09:00 - 12:00</p>

          <div id="studentid">
          <h2>All Student IDs</h2>
          <ul>
            <li>Thai Viet: 106209450 </li>
            <li>Gia Khanh: 106202572 </li>
            <li>Hai Anh: 106209094 </li>
            <li>Tuan Khoa: 106208554 </li>
          </ul>
          </div>

       
          <h2>Tutor</h2>
          <p><strong>Tutor's name: </strong>Thomas Harrison</p>


          <h2>Project Structure (Nested List)</h2>
          <div class="nested-list" aria-hidden="true">
            <ul>
              <li>Website
                <ul>
                  <li>index.php</li>
                  <li>about.php
                    <ul>
                      <li>images</li>
                      <li>team info</li>
                    </ul>
                  </li>
                  <li>jobs.php</li>
                  <li>apply.php</li>
                </ul>
              </li>
              <li>Assets
                <ul>
                  <li>logo.png</li>
                  <li>groupphoto.jpg</li>
                </ul>
              </li>
            </ul>
          </div>
  <section>
          <figure>
            <h2>Group Photo</h2>
          <img src="groupphoto.jpg" alt="group photo"/>
            <figcaption>SoftDevs Student Team — Project photo</figcaption>
          </figure>
          
          <h2>Members Contributions</h2>
       <table>
            <caption>Members Contribution</caption>
            <thead>
              <tr>
                <th>Member</th>
                <th>Part 1</th>
                <th>Part 2</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Viet</td>
                <td>Code "apply.html" & "jobs.html"</td>
                <td>Code "header.inc" & "footer.inc"  & "settings.php"</td>
              </tr>

              <tr>
                <td>Khanh</td>
                <td>Code "about.html" & "index.html" & ask questions</td>
                <td>Code "manage.php" & create 'jobs' table in MySQL database</td>
              </tr>

              <tr>
                <td>Khoa</td>
                <td>Check & code “styles.css” for 4 HTML files above</td>
                <td>Code "process_eoi.php" & create 'eoi' table in MySQL database</td>
              </tr>

              <tr>
                <td>Hai Anh</td>
                <td>Thoroughly validate/check all files (make sure all files synchronise with each other) → upload & manage the final product in Github and Canvas</td>
                <td>Code "enhancements.php", validate/check to ensure all files synchronise with each other) → upload & manage the final product in Github and Canvas </td>
              </tr>


              </tr>
            </tbody>
          </table>
        </figure>


          <aside>
          <h2 style="margin-top:18px">Members Interests</h2>

          <table>
            <caption>Hobbies and favourite media of group members</caption>
            <thead>
              <tr>
                <th>Member</th>
                <th>Hobbies</th>
                <th>Favourite Films</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Viet</td>
                <td>Coding</td>
                <td>Inception film</td>
              </tr>

              <tr>
                <td>Khanh</td>
                <td>Coding</td>
                <td>Inception film</td>
              </tr>

              <tr>
                <td>Khoa</td>
                <td>Coding</td>
                <td>The Matrix film</td>
              </tr>

              <tr>
                <td>Hai Anh</td>
                <td>Coding & Testing</td>
                <td>Godfather film</td>
              </tr>


              </tr>
            </tbody>
          </table>
          </aside>
</section>
      </div>

    </main>

    <hr>

   <!-- footer.inc -->
    <footer class="footer">
    <p>&copy; <?php echo date("Y"); ?> Group 1 – COS10026 Web Technology</p>
    <p>For academic use only – Project Part 2</p>
</footer>

</body>
</html>