  <!-- ===== Sidebar Start ===== -->
  <aside :class="sidebarToggle ? 'translate-x-0' : '-translate-x-full'"
      class="absolute left-0 top-0 z-9999 flex h-screen w-72.5 flex-col overflow-y-hidden bg-black duration-300 ease-linear dark:bg-boxdark lg:static lg:translate-x-0"
      @click.outside="sidebarToggle = false">
      <!-- SIDEBAR HEADER -->
      <div
          class="flex items-center justify-between gap-2 px-6 py-5.5 border-0 border-end-3 lg:py-5.5 bg-white drop-shadow-1 dark:bg-boxdark dark:drop-shadow-none">
          <div class="d-flex flex item items-center">
              <a href="{{ route('admin.dashboard.index') }}" class="text-md">
                  <img class="h-12.5" src="{{ asset('images/general/logo-dark.png') }}" alt="Logo" />
              </a>
              <span class="text-sm ms-2 fw-bold">NEW DOOR VENTURES</span>
          </div>


          <button class="block lg:hidden" @click.stop="sidebarToggle = !sidebarToggle">
              <svg class="fill-current" width="20" height="18" viewBox="0 0 20 18" fill="none"
                  xmlns="http://www.w3.org/2000/svg">
                  <path
                      d="M19 8.175H2.98748L9.36248 1.6875C9.69998 1.35 9.69998 0.825 9.36248 0.4875C9.02498 0.15 8.49998 0.15 8.16248 0.4875L0.399976 8.3625C0.0624756 8.7 0.0624756 9.225 0.399976 9.5625L8.16248 17.4375C8.31248 17.5875 8.53748 17.7 8.76248 17.7C8.98748 17.7 9.17498 17.625 9.36248 17.475C9.69998 17.1375 9.69998 16.6125 9.36248 16.275L3.02498 9.8625H19C19.45 9.8625 19.825 9.4875 19.825 9.0375C19.825 8.55 19.45 8.175 19 8.175Z"
                      fill="" />
              </svg>
          </button>
      </div>
      <!-- SIDEBAR HEADER -->

      <div class="no-scrollbar flex flex-col overflow-y-auto duration-300 ease-linear">
          <!-- Sidebar Menu -->
          <nav class="mt-5 px-4  lg:px-6" x-data="{ selected: $persist('Dashboard'), page: $persist('') }">
              <!-- Menu Group -->
              <div>
                  <h3 class="mb-4 ml-4 text-sm font-medium text-bodydark2">MENU</h3>

                  <ul class="mb-6 flex flex-col gap-1.5">
                      <!-- Menu Item Dashboard -->
                      <li>
                          <a class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                              href="{{ route('admin.dashboard.index') }}"
                              @click="selected = (selected === 'Dashboard' ? '':'Dashboard')"
                              :class="{ 'bg-theme dark:bg-meta-4': (selected === 'Dashboard') }">
                              <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path
                                      d="M6.10322 0.956299H2.53135C1.5751 0.956299 0.787598 1.7438 0.787598 2.70005V6.27192C0.787598 7.22817 1.5751 8.01567 2.53135 8.01567H6.10322C7.05947 8.01567 7.84697 7.22817 7.84697 6.27192V2.72817C7.8751 1.7438 7.0876 0.956299 6.10322 0.956299ZM6.60947 6.30005C6.60947 6.5813 6.38447 6.8063 6.10322 6.8063H2.53135C2.2501 6.8063 2.0251 6.5813 2.0251 6.30005V2.72817C2.0251 2.44692 2.2501 2.22192 2.53135 2.22192H6.10322C6.38447 2.22192 6.60947 2.44692 6.60947 2.72817V6.30005Z"
                                      fill="" />
                                  <path
                                      d="M15.4689 0.956299H11.8971C10.9408 0.956299 10.1533 1.7438 10.1533 2.70005V6.27192C10.1533 7.22817 10.9408 8.01567 11.8971 8.01567H15.4689C16.4252 8.01567 17.2127 7.22817 17.2127 6.27192V2.72817C17.2127 1.7438 16.4252 0.956299 15.4689 0.956299ZM15.9752 6.30005C15.9752 6.5813 15.7502 6.8063 15.4689 6.8063H11.8971C11.6158 6.8063 11.3908 6.5813 11.3908 6.30005V2.72817C11.3908 2.44692 11.6158 2.22192 11.8971 2.22192H15.4689C15.7502 2.22192 15.9752 2.44692 15.9752 2.72817V6.30005Z"
                                      fill="" />
                                  <path
                                      d="M6.10322 9.92822H2.53135C1.5751 9.92822 0.787598 10.7157 0.787598 11.672V15.2438C0.787598 16.2001 1.5751 16.9876 2.53135 16.9876H6.10322C7.05947 16.9876 7.84697 16.2001 7.84697 15.2438V11.7001C7.8751 10.7157 7.0876 9.92822 6.10322 9.92822ZM6.60947 15.272C6.60947 15.5532 6.38447 15.7782 6.10322 15.7782H2.53135C2.2501 15.7782 2.0251 15.5532 2.0251 15.272V11.7001C2.0251 11.4188 2.2501 11.1938 2.53135 11.1938H6.10322C6.38447 11.1938 6.60947 11.4188 6.60947 11.7001V15.272Z"
                                      fill="" />
                                  <path
                                      d="M15.4689 9.92822H11.8971C10.9408 9.92822 10.1533 10.7157 10.1533 11.672V15.2438C10.1533 16.2001 10.9408 16.9876 11.8971 16.9876H15.4689C16.4252 16.9876 17.2127 16.2001 17.2127 15.2438V11.7001C17.2127 10.7157 16.4252 9.92822 15.4689 9.92822ZM15.9752 15.272C15.9752 15.5532 15.7502 15.7782 15.4689 15.7782H11.8971C11.6158 15.7782 11.3908 15.5532 11.3908 15.272V11.7001C11.3908 11.4188 11.6158 11.1938 11.8971 11.1938H15.4689C15.7502 11.1938 15.9752 11.4188 15.9752 11.7001V15.272Z"
                                      fill="" />
                              </svg>
                              Dashboard
                          </a>
                      </li>
                      <!-- Menu Item Dashboard -->
                      @if (permission_check('Property List'))
                          <!-- Menu Item Properties -->
                          <li>
                              <a class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                                  href="{{ route('admin.properties.index') }}"
                                  @click="selected = (selected === 'Properties' ? '':'Properties')"
                                  :class="{ 'bg-theme dark:bg-meta-4': (selected === 'Properties') }">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                      fill="currentColor" class="bi bi-building-check" viewBox="0 0 16 16">
                                      <path
                                          d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514" />
                                      <path
                                          d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v6.5a.5.5 0 0 1-1 0V1H3v14h3v-2.5a.5.5 0 0 1 .5-.5H8v4H3a1 1 0 0 1-1-1z" />
                                      <path
                                          d="M4.5 2a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm-6 3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm-6 3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5z" />
                                  </svg>
                                  Properties
                              </a>
                          </li>
                      @endif
                      <!-- Menu Item Properties -->
                      @if (permission_check('Project List'))
                          <!-- Menu Item Projects -->
                          <li>
                              <a class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                                  href="{{ route('admin.projects.index') }}"
                                  @click="selected = (selected === 'Projects' ? '':'Projects')"
                                  :class="{ 'bg-theme dark:bg-meta-4': (selected === 'Projects') }">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                      fill="currentColor" class="bi bi-buildings" viewBox="0 0 16 16">
                                      <path
                                          d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022M6 8.694 1 10.36V15h5zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5z" />
                                      <path
                                          d="M2 11h1v1H2zm2 0h1v1H4zm-2 2h1v1H2zm2 0h1v1H4zm4-4h1v1H8zm2 0h1v1h-1zm-2 2h1v1H8zm2 0h1v1h-1zm2-2h1v1h-1zm0 2h1v1h-1zM8 7h1v1H8zm2 0h1v1h-1zm2 0h1v1h-1zM8 5h1v1H8zm2 0h1v1h-1zm2 0h1v1h-1zm0-2h1v1h-1z" />
                                  </svg>
                                  Projects
                              </a>
                          </li>
                      @endif
                      <!-- Menu Item Projects -->
                      @if (permission_check('Builder List'))
                          <!-- Menu Item Builders -->
                          <li>
                              <a class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                                  href="{{ route('admin.builders.index') }}"
                                  @click="selected = (selected === 'Builders' ? '':'Builders')"
                                  :class="{ 'bg-theme dark:bg-meta-4': (selected === 'Builders') }">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                      fill="currentColor" class="bi bi-person-gear" viewBox="0 0 16 16">
                                      <path
                                          d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m.256 7a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1zm3.63-4.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382zM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0" />
                                  </svg>
                                  Builders
                              </a>
                          </li>
                      @endif
                      <!-- Menu Item Builders -->
                      @if (permission_check('Account List'))
                          <!-- Menu Item Accounts -->
                          <li>
                              <a class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                                  href="{{ route('admin.accounts.index') }}"
                                  @click="selected = (selected === 'Accounts' ? '':'Accounts')"
                                  :class="{ 'bg-theme dark:bg-meta-4': (selected === 'Accounts') }">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                      fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                                      <path
                                          d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4" />
                                  </svg>
                                  Accounts
                              </a>
                          </li>
                      @endif
                      <!-- Menu Item Accounts -->
                      <!-- Menu Item Consults -->
                      @if (permission_check('Leads Attend'))
                          <li>
                              <a class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                                  href="{{ route('admin.consults.index') }}"
                                  @click="selected = (selected === 'Consults' ? '':'Consults')"
                                  :class="{ 'bg-theme dark:bg-meta-4': (selected === 'Consults') }">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                      fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                                      <path
                                          d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1z" />
                                  </svg>
                                  Leads
                              </a>
                          </li>
                      @endif
                      @if (permission_check('Enquiry Attend'))
                          <!-- Menu Item Contact -->
                          <li>
                              <a class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                                  href="{{ route('admin.contact.index') }}"
                                  @click="selected = (selected === 'Contact' ? '':'Contact')"
                                  :class="{ 'bg-theme dark:bg-meta-4': (selected === 'Contact') }">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                      fill="currentColor" class="bi bi-person-vcard" viewBox="0 0 16 16">
                                      <path
                                          d="M5 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4m4-2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5M9 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 9 8m1 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5" />
                                      <path
                                          d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H8.96q.04-.245.04-.5C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1 1 0 0 1 1 12z" />
                                  </svg>
                                  Contact Form
                              </a>
                          </li>
                      @endif
                      @if (permission_check('Setup Manage'))
                          <!-- Menu Item Task -->
                          <li>
                              <a class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                                  href="#" @click.prevent="selected = (selected === 'Setup' ? '':'Setup')"
                                  :class="{
                                      'bg-theme dark:bg-meta-4': (selected === 'Setup')
                                  }">
                                  {{-- || (
                                    page === 'categories' ||
                                    page ===  'amenities' ||
                                    page === 'landmarks' ||
                                    page === 'furnishing' ||
                                    page === 'rules' ||
                                    page === 'advertisement' ||
                                    page === 'custom-fields' ||
                                    page === 'configration') --}}
                                  <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18"
                                      fill="none" xmlns="http://www.w3.org/2000/svg">
                                      <g clip-path="url(#clip0_130_9728)">
                                          <path
                                              d="M3.45928 0.984375H1.6874C1.04053 0.984375 0.478027 1.51875 0.478027 2.19375V3.96563C0.478027 4.6125 1.0124 5.175 1.6874 5.175H3.45928C4.10615 5.175 4.66865 4.64063 4.66865 3.96563V2.16562C4.64053 1.51875 4.10615 0.984375 3.45928 0.984375ZM3.3749 3.88125H1.77178V2.25H3.3749V3.88125Z"
                                              fill="" />
                                          <path
                                              d="M7.22793 3.71245H16.8748C17.2123 3.71245 17.5217 3.4312 17.5217 3.06558C17.5217 2.69995 17.2404 2.4187 16.8748 2.4187H7.22793C6.89043 2.4187 6.58105 2.69995 6.58105 3.06558C6.58105 3.4312 6.89043 3.71245 7.22793 3.71245Z"
                                              fill="" />
                                          <path
                                              d="M3.45928 6.75H1.6874C1.04053 6.75 0.478027 7.28437 0.478027 7.95937V9.73125C0.478027 10.3781 1.0124 10.9406 1.6874 10.9406H3.45928C4.10615 10.9406 4.66865 10.4062 4.66865 9.73125V7.95937C4.64053 7.28437 4.10615 6.75 3.45928 6.75ZM3.3749 9.64687H1.77178V8.01562H3.3749V9.64687Z"
                                              fill="" />
                                          <path
                                              d="M16.8748 8.21252H7.22793C6.89043 8.21252 6.58105 8.49377 6.58105 8.8594C6.58105 9.22502 6.86231 9.47815 7.22793 9.47815H16.8748C17.2123 9.47815 17.5217 9.1969 17.5217 8.8594C17.5217 8.5219 17.2123 8.21252 16.8748 8.21252Z"
                                              fill="" />
                                          <path
                                              d="M3.45928 12.8531H1.6874C1.04053 12.8531 0.478027 13.3875 0.478027 14.0625V15.8344C0.478027 16.4813 1.0124 17.0438 1.6874 17.0438H3.45928C4.10615 17.0438 4.66865 16.5094 4.66865 15.8344V14.0625C4.64053 13.3875 4.10615 12.8531 3.45928 12.8531ZM3.3749 15.75H1.77178V14.1188H3.3749V15.75Z"
                                              fill="" />
                                          <path
                                              d="M16.8748 14.2875H7.22793C6.89043 14.2875 6.58105 14.5687 6.58105 14.9344C6.58105 15.3 6.86231 15.5812 7.22793 15.5812H16.8748C17.2123 15.5812 17.5217 15.3 17.5217 14.9344C17.5217 14.5687 17.2123 14.2875 16.8748 14.2875Z"
                                              fill="" />
                                      </g>
                                      <defs>
                                          <clipPath id="clip0_130_9728">
                                              <rect width="18" height="18" fill="white" />
                                          </clipPath>
                                      </defs>
                                  </svg>

                                  Setup

                                  <svg class="absolute right-4 top-1/2 -translate-y-1/2 fill-current"
                                      :class="{ 'rotate-180': (selected === 'Setup') }" width="20"
                                      height="20" viewBox="0 0 20 20" fill="none"
                                      xmlns="http://www.w3.org/2000/svg">
                                      <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M4.41107 6.9107C4.73651 6.58527 5.26414 6.58527 5.58958 6.9107L10.0003 11.3214L14.4111 6.91071C14.7365 6.58527 15.2641 6.58527 15.5896 6.91071C15.915 7.23614 15.915 7.76378 15.5896 8.08922L10.5896 13.0892C10.2641 13.4147 9.73651 13.4147 9.41107 13.0892L4.41107 8.08922C4.08563 7.76378 4.08563 7.23614 4.41107 6.9107Z"
                                          fill="" />
                                  </svg>
                              </a>

                              <!-- Dropdown Menu Start -->
                              <div class="translate transform overflow-hidden"
                                  :class="(selected === 'Setup') ? 'block' : 'hidden'">
                                  <ul class="mb-5.5 mt-4 flex flex-col gap-2.5 pl-6">
                                      <li>
                                          <a class="group relative flex items-center gap-2.5 rounded-md px-4 font-medium text-bodydark2 duration-300 ease-in-out hover:text-white"
                                              href="{{ route('admin.categories.index') }}"
                                              @click="page = (page === 'categories' ? '' : 'categories')"
                                              :class="page === 'categories' && '!text-white'">Categories
                                          </a>
                                      </li>
                                      <li>
                                          <a class="group relative flex items-center gap-2.5 rounded-md px-4 font-medium text-bodydark2 duration-300 ease-in-out hover:text-white"
                                              href="{{ route('admin.amenities.index') }}"
                                              @click="page = (page ===  'amenities' ? '' :  'amenities')"
                                              :class="page ===  'amenities' && '!text-white'">Amenities
                                          </a>
                                      </li>
                                      <li>
                                          <a class="group relative flex items-center gap-2.5 rounded-md px-4 font-medium text-bodydark2 duration-300 ease-in-out hover:text-white"
                                              href="{{ route('admin.landmark.index') }}"
                                              @click="page = (page === 'landmarks' ? '' : 'landmarks')"
                                              :class="page === 'landmarks' && '!text-white'">Landmarks
                                          </a>
                                      </li>

                                      <li>
                                          <a class="group relative flex items-center gap-2.5 rounded-md px-4 font-medium text-bodydark2 duration-300 ease-in-out hover:text-white"
                                              href="{{ route('admin.furnishing.index') }}"
                                              @click="page = (page === 'furnishing' ? '' : 'furnishing')"
                                              :class="page === 'furnishing' && '!text-white'">Furnishing
                                          </a>
                                      </li>
                                      <li>
                                          <a class="group relative flex items-center gap-2.5 rounded-md px-4 font-medium text-bodydark2 duration-300 ease-in-out hover:text-white"
                                              href="{{ route('admin.rules.index') }}"
                                              @click="page = (page === 'rules' ? '' : 'rules')"
                                              :class="page === 'rules' && '!text-white'">Rules
                                          </a>
                                      </li>

                                      <li>
                                          <a class="group relative flex items-center gap-2.5 rounded-md px-4 font-medium text-bodydark2 duration-300 ease-in-out hover:text-white"
                                              href="{{ route('admin.advertisement.index') }}"
                                              @click="page = (page === 'advertisement' ? '' : 'advertisement')"
                                              :class="page === 'advertisement' && '!text-white'">Advertisement
                                          </a>
                                      </li>
                                      <li>
                                          <a class="group relative flex items-center gap-2.5 rounded-md px-4 font-medium text-bodydark2 duration-300 ease-in-out hover:text-white"
                                              href="{{ route('admin.custom-fields.index') }}"
                                              @click="page = (page === 'custom-fields' ? '' : 'custom-fields')"
                                              :class="page === 'custom-fields' && '!text-white'">Custom Fields
                                          </a>
                                      </li>
                                      <li>
                                          <a class="group relative flex items-center gap-2.5 rounded-md px-4 font-medium text-bodydark2 duration-300 ease-in-out hover:text-white"
                                              href="{{ route('admin.configration.index') }}"
                                              @click="page = (page === 'configration' ? '' : 'configration')"
                                              :class="page === 'configration' && '!text-white'">Configurations
                                          </a>
                                      </li>

                                  </ul>
                              </div>
                              <!-- Dropdown Menu End -->
                          </li>
                          <!-- Menu Item Task -->
                      @endif
                      @if (permission_check('Newsletters'))
                          <!-- Menu Item Newsletters -->
                          <li>
                              <a class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                                  href="{{ route('admin.newsletter.index') }}"
                                  @click="selected = (selected === 'Newsletters' ? '':'Newsletters')"
                                  :class="{
                                      'bg-theme dark:bg-meta-4': (selected === 'Newsletters')
                                  }">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                      fill="currentColor" class="bi bi-person-hearts" viewBox="0 0 16 16">
                                      <path fill-rule="evenodd"
                                          d="M11.5 1.246c.832-.855 2.913.642 0 2.566-2.913-1.924-.832-3.421 0-2.566M9 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h10s1 0 1-1-1-4-6-4-6 3-6 4m13.5-8.09c1.387-1.425 4.855 1.07 0 4.277-4.854-3.207-1.387-5.702 0-4.276ZM15 2.165c.555-.57 1.942.428 0 1.711-1.942-1.283-.555-2.281 0-1.71Z" />
                                  </svg>
                                  Newsletters
                              </a>
                          </li>
                      @endif
                      <!-- Menu Item Newsletters -->
                      
                      @if (permission_check('Blogs Manage'))
                          <li>
                              <a class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                                  href="#" @click.prevent="selected = (selected === 'Blogs' ? '':'Blogs')"
                                  :class="{
                                      'bg-theme dark:bg-meta-4': (selected === 'Blogs') || (
                                          page === 'list' ||
                                          page === 'kanban')
                                  }">
                                  <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18"
                                      fill="none" xmlns="http://www.w3.org/2000/svg">
                                      <g clip-path="url(#clip0_130_9728)">
                                          <path
                                              d="M3.45928 0.984375H1.6874C1.04053 0.984375 0.478027 1.51875 0.478027 2.19375V3.96563C0.478027 4.6125 1.0124 5.175 1.6874 5.175H3.45928C4.10615 5.175 4.66865 4.64063 4.66865 3.96563V2.16562C4.64053 1.51875 4.10615 0.984375 3.45928 0.984375ZM3.3749 3.88125H1.77178V2.25H3.3749V3.88125Z"
                                              fill="" />
                                          <path
                                              d="M7.22793 3.71245H16.8748C17.2123 3.71245 17.5217 3.4312 17.5217 3.06558C17.5217 2.69995 17.2404 2.4187 16.8748 2.4187H7.22793C6.89043 2.4187 6.58105 2.69995 6.58105 3.06558C6.58105 3.4312 6.89043 3.71245 7.22793 3.71245Z"
                                              fill="" />
                                          <path
                                              d="M3.45928 6.75H1.6874C1.04053 6.75 0.478027 7.28437 0.478027 7.95937V9.73125C0.478027 10.3781 1.0124 10.9406 1.6874 10.9406H3.45928C4.10615 10.9406 4.66865 10.4062 4.66865 9.73125V7.95937C4.64053 7.28437 4.10615 6.75 3.45928 6.75ZM3.3749 9.64687H1.77178V8.01562H3.3749V9.64687Z"
                                              fill="" />
                                          <path
                                              d="M16.8748 8.21252H7.22793C6.89043 8.21252 6.58105 8.49377 6.58105 8.8594C6.58105 9.22502 6.86231 9.47815 7.22793 9.47815H16.8748C17.2123 9.47815 17.5217 9.1969 17.5217 8.8594C17.5217 8.5219 17.2123 8.21252 16.8748 8.21252Z"
                                              fill="" />
                                          <path
                                              d="M3.45928 12.8531H1.6874C1.04053 12.8531 0.478027 13.3875 0.478027 14.0625V15.8344C0.478027 16.4813 1.0124 17.0438 1.6874 17.0438H3.45928C4.10615 17.0438 4.66865 16.5094 4.66865 15.8344V14.0625C4.64053 13.3875 4.10615 12.8531 3.45928 12.8531ZM3.3749 15.75H1.77178V14.1188H3.3749V15.75Z"
                                              fill="" />
                                          <path
                                              d="M16.8748 14.2875H7.22793C6.89043 14.2875 6.58105 14.5687 6.58105 14.9344C6.58105 15.3 6.86231 15.5812 7.22793 15.5812H16.8748C17.2123 15.5812 17.5217 15.3 17.5217 14.9344C17.5217 14.5687 17.2123 14.2875 16.8748 14.2875Z"
                                              fill="" />
                                      </g>
                                      <defs>
                                          <clipPath id="clip0_130_9728">
                                              <rect width="18" height="18" fill="white" />
                                          </clipPath>
                                      </defs>
                                  </svg>

                                  Blogs

                                  <svg class="absolute right-4 top-1/2 -translate-y-1/2 fill-current"
                                      :class="{ 'rotate-180': (selected === 'Blogs') }" width="20"
                                      height="20" viewBox="0 0 20 20" fill="none"
                                      xmlns="http://www.w3.org/2000/svg">
                                      <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M4.41107 6.9107C4.73651 6.58527 5.26414 6.58527 5.58958 6.9107L10.0003 11.3214L14.4111 6.91071C14.7365 6.58527 15.2641 6.58527 15.5896 6.91071C15.915 7.23614 15.915 7.76378 15.5896 8.08922L10.5896 13.0892C10.2641 13.4147 9.73651 13.4147 9.41107 13.0892L4.41107 8.08922C4.08563 7.76378 4.08563 7.23614 4.41107 6.9107Z"
                                          fill="" />
                                  </svg>
                              </a>

                              <!-- Dropdown Menu Start -->
                              <div class="translate transform overflow-hidden"
                                  :class="(selected === 'Blogs') ? 'block' : 'hidden'">
                                  <ul class="mb-5.5 mt-4 flex flex-col gap-2.5 pl-6">
                                      <li>
                                          <a class="group relative flex items-center gap-2.5 rounded-md px-4 font-medium text-bodydark2 duration-300 ease-in-out hover:text-white"
                                              href="{{ route('admin.blogs-category.index') }}"
                                              :class="page === 'blog-category' && '!text-white'">Category
                                          </a>
                                      </li>
                                      <li>
                                          <a class="group relative flex items-center gap-2.5 rounded-md px-4 font-medium text-bodydark2 duration-300 ease-in-out hover:text-white"
                                              href="{{ route('admin.blogs.index') }}"
                                              :class="page === 'blogs' && '!text-white'">Post</a>
                                      </li>
                                  </ul>
                              </div>
                              <!-- Dropdown Menu End -->
                          </li>
                      @endif
                      @if (permission_check('Trash'))
                          <!-- Menu Item Activity Logs -->
                          <li>
                              <a class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                                  href="{{ route('admin.trash.index') }}"
                                  @click="selected = (selected === 'Trash' ? '':'Trash')"
                                  :class="{ 'bg-theme dark:bg-meta-4': (selected === 'Trash') }">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                      fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                      <path
                                          d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                      <path
                                          d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                  </svg>
                                  Trash
                              </a>
                          </li>
                          <!-- Menu Item Activity Logs -->
                      @endif
                      @if (permission_check('Activity Logs'))
                          <!-- Menu Item Activity Logs -->
                          <li>
                              <a class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                                  href="{{ route('admin.activity.index') }}"
                                  @click="selected = (selected === 'Activity' ? '':'Activity')"
                                  :class="{ 'bg-theme dark:bg-meta-4': (selected === 'Activity') }">
                                  <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18"
                                      fill="none" xmlns="http://www.w3.org/2000/svg">
                                      <path
                                          d="M15.7499 2.9812H14.2874V2.36245C14.2874 2.02495 14.0062 1.71558 13.6405 1.71558C13.2749 1.71558 12.9937 1.99683 12.9937 2.36245V2.9812H4.97803V2.36245C4.97803 2.02495 4.69678 1.71558 4.33115 1.71558C3.96553 1.71558 3.68428 1.99683 3.68428 2.36245V2.9812H2.2499C1.29365 2.9812 0.478027 3.7687 0.478027 4.75308V14.5406C0.478027 15.4968 1.26553 16.3125 2.2499 16.3125H15.7499C16.7062 16.3125 17.5218 15.525 17.5218 14.5406V4.72495C17.5218 3.7687 16.7062 2.9812 15.7499 2.9812ZM1.77178 8.21245H4.1624V10.9968H1.77178V8.21245ZM5.42803 8.21245H8.38115V10.9968H5.42803V8.21245ZM8.38115 12.2625V15.0187H5.42803V12.2625H8.38115ZM9.64678 12.2625H12.5999V15.0187H9.64678V12.2625ZM9.64678 10.9968V8.21245H12.5999V10.9968H9.64678ZM13.8374 8.21245H16.228V10.9968H13.8374V8.21245ZM2.2499 4.24683H3.7124V4.83745C3.7124 5.17495 3.99365 5.48433 4.35928 5.48433C4.7249 5.48433 5.00615 5.20308 5.00615 4.83745V4.24683H13.0499V4.83745C13.0499 5.17495 13.3312 5.48433 13.6968 5.48433C14.0624 5.48433 14.3437 5.20308 14.3437 4.83745V4.24683H15.7499C16.0312 4.24683 16.2562 4.47183 16.2562 4.75308V6.94683H1.77178V4.75308C1.77178 4.47183 1.96865 4.24683 2.2499 4.24683ZM1.77178 14.5125V12.2343H4.1624V14.9906H2.2499C1.96865 15.0187 1.77178 14.7937 1.77178 14.5125ZM15.7499 15.0187H13.8374V12.2625H16.228V14.5406C16.2562 14.7937 16.0312 15.0187 15.7499 15.0187Z"
                                          fill="" />
                                  </svg>
                                  Activity Logs
                              </a>
                          </li>
                          <!-- Menu Item Activity Logs -->
                      @endif
                  </ul>
              </div>
          </nav>
          <!-- Sidebar Menu -->
      </div>
  </aside>
