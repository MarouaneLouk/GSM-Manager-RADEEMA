document.addEventListener("DOMContentLoaded", function() {
   var tbody = document.querySelector("tbody");
   var pageUl = document.querySelector(".pagination");
   var itemShow = document.querySelector("#itemperpage");
   var rowNum = pageUl.querySelector("#rows-per-page");
   var tr = tbody.querySelectorAll("tr");
   var emptyBox = [];
   var index = 1;
   var itemPerPage = 10;

   for(let i = 0; i < tr.length; i++){
       emptyBox.push(tr[i]);
   }

   const num_of_tr = emptyBox.length;
   itemShow.addEventListener('change', giveTrPerPage);

   function giveTrPerPage(){
       if(this.value === "all"){
           itemPerPage = num_of_tr;
       } else {
           itemPerPage = Number(this.value);
       }
       rowNum.textContent = `Rows per page: ${itemPerPage}`;
       if(num_of_tr <= itemPerPage){
           displayPage(num_of_tr);
       } else {
           displayPage(itemPerPage);
       }
       pageGenerator(itemPerPage);
       getElement(itemPerPage);
   }

   function displayPage(limit){
       tbody.innerHTML = '';
       for(let i = 0; i < limit; i++){
           tbody.appendChild(emptyBox[i]);
       }
       attachViewMoreListeners();
       const pageNum = pageUl.querySelectorAll(".list");
       pageNum.forEach(n => n.remove());
   }

   if(num_of_tr <= itemPerPage){
       displayPage(num_of_tr);
   } else {
       displayPage(itemPerPage);
   }

   function pageGenerator(getem){
       if(num_of_tr <= getem){
           pageUl.style.display = 'none';
       } else {
           pageUl.style.display = 'flex';
           const num_of_page = Math.ceil(num_of_tr / getem);
           for(let i = 1; i <= num_of_page; i++){
               const li = document.createElement('li');
               li.className = 'list';
               const a = document.createElement('a');
               a.href = "#";
               a.innerText = i;
               a.setAttribute('data-page', i);
               li.appendChild(a);
               pageUl.insertBefore(li, pageUl.querySelector(".next"));
           }
       }
   }

   pageGenerator(itemPerPage);

   let pageLink = pageUl.querySelectorAll('a');
   let lastPage = pageLink.length - 2;

   function pageRunner(page, items, lastPage, active){
       for(let button of page){
           button.onclick = e => {
               const page_num = e.target.getAttribute("data-page");
               const page_mover = e.target.getAttribute("id");
               if(page_num != null){
                   index = page_num; 
               } else {
                   if(page_mover === "next"){
                       index++;
                       if(index >= lastPage){
                           index = lastPage;
                       }
                   } else {
                       index--;
                       if(index <= 1){
                           index = 1;
                       }
                   }
               }
               pageMaker(index, items, active);
           }
       }
   }

   var pageLi = pageUl.querySelectorAll(".list");
   pageLi[0].classList.add("active");
   pageRunner(pageLink, itemPerPage, lastPage, pageLi);

   function getElement(val){
       let pagelink = pageUl.querySelectorAll("a");
       let lastpage = pagelink.length - 2;
       let pageli = pageUl.querySelectorAll(".list");
       pageli[0].classList.add("active");
       pageRunner(pagelink, val, lastpage, pageli);
   }

   function pageMaker(index, item_per_page, activePage){
       const start = item_per_page * (index - 1);
       const end = start + item_per_page;
       const current_page = emptyBox.slice(start, end);
       tbody.innerHTML = '';
       for(let i = 0; i < current_page.length; i++){
           let item = current_page[i];
           tbody.appendChild(item);
       }
       Array.from(activePage).forEach((e) => {
           e.classList.remove("active");
       });
       activePage[index - 1].classList.add("active");
       attachViewMoreListeners();
   }

   function attachViewMoreListeners(){
       document.querySelectorAll('.view-more-btn').forEach(button => {
           button.addEventListener('click', function(){
               const popupId = this.getAttribute('data-popup');
               const popup = document.getElementById(popupId);
               document.body.appendChild(popup);
               popup.style.display = 'flex';
           });
       });

       document.querySelectorAll('.close-btn').forEach(button => {
           button.addEventListener('click', function(){
               const popup = this.closest('.popup-overlay');
               popup.style.display = 'none';
           });
       });
   }

   attachViewMoreListeners();
});
