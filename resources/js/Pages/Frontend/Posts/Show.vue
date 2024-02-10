<template>
  <guest-layout>
    <section class="flex flex-col gap-4 md:flex-row">
      <div class="w-full md:w-8/12">
        <div class="p-4 bg-white sm:rounded-lg">
          <h2 class="font-semibold text-2xl text-black">
            <Link :href="route('frontend.communities.show', community.slug)">
              t/{{ community.name }}
            </Link>
          </h2>
        </div>
        <div class="flex mt-2 bg-white sm:rounded-lg text-xs text-gray-500">
          <div>
            <PostVote :post="post.data" />
          </div>
          <div class="w-full">
            <div class="flex gap-1 justify-between ml-2 mt-2 mr-2 p-2">
              <div class="pb-2">
                Опубликовано пользователем
                <span class="text-gray-500">{{
                  post.data.name
                }}</span>
                {{ post.data.created_at }}
              </div>
              <div class="flex gap-1 justify-end">
                  <Link
                    v-if="can_update"
                    :href="route('communities.posts.edit', [community.slug, post.data.slug])"
                    class="px-2 py-2 flex items-center hover:bg-gray-100 rounded link-hover">
                      <svg class="edit-svg-icon" width="15" height="15" viewBox="0 0 481 481" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M239.751 480.27C200.301 480.27 160.861 480.38 121.411 480.24C71.3711 480.07 28.4111 451.5 9.49113 406.03C3.47113 391.57 0.491129 376.49 0.491129 360.84C0.481129 280.7 0.21113 200.57 0.58113 120.43C0.84113 65.6101 36.4411 19.4701 89.2111 5.20008C99.4411 2.44008 110.371 1.23008 121.001 1.15008C176.171 0.760079 231.351 0.940081 286.531 0.980081C301.681 0.990081 312.361 11.4601 312.041 25.7701C311.791 37.0801 302.771 47.1601 291.531 48.5601C289.191 48.8501 286.801 48.8501 284.431 48.8501C230.131 48.8701 175.821 48.8201 121.521 48.8801C89.1411 48.9101 62.1511 67.9401 52.1611 98.3601C49.8311 105.47 48.5511 113.26 48.5311 120.74C48.2811 200.63 48.2611 280.51 48.4211 360.4C48.4911 395.74 73.4111 425.14 108.031 431.29C112.551 432.09 117.221 432.33 121.821 432.33C200.721 432.39 279.611 432.4 358.511 432.36C394.811 432.34 423.881 408.5 430.751 373C431.741 367.9 431.871 362.57 431.871 357.35C431.951 303.05 431.911 248.75 431.931 194.46C431.941 182.77 437.271 174.36 446.991 170.45C461.951 164.42 478.511 174.75 479.701 190.85C479.801 192.22 479.811 193.59 479.811 194.97C479.811 249.52 479.941 304.07 479.771 358.61C479.641 400.9 462.241 434.58 427.811 459.09C407.061 473.86 383.551 480.37 358.101 480.31C318.641 480.19 279.201 480.27 239.751 480.27Z"/>
                        <path d="M426.69 0.97998C447.58 2.08998 465.67 12.92 475.13 35.33C484.22 56.86 481.14 77.66 465.13 94.84C445.83 115.55 425.34 135.16 405.32 155.2C372.78 187.78 340.11 220.24 307.71 252.96C301.21 259.52 294.12 264.2 285.23 266.97C264.89 273.3 244.79 280.38 224.54 287C215.1 290.09 206.44 288.35 199.36 281.23C192.28 274.11 190.66 265.46 193.77 256.01C201.04 233.88 208.26 211.73 215.91 189.73C217.41 185.42 220.11 181.11 223.34 177.87C276.32 124.61 329.49 71.54 382.6 18.41C393.9 7.09997 407.43 1.13998 426.69 0.97998Z"/>
                      </svg>
                  </Link>
                  <Link
                    v-if="can_delete"
                    :href="route('communities.posts.destroy', [community.slug, post.data.slug])"
                    class="px-2 py-2 flex items-center hover:bg-gray-100 rounded link-hover"
                    method="delete"
                    as="button"
                    type="button">
                      <svg class="delete-svg-icon" width="16" height="16" viewBox="0 0 504 617" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M419.722 352.76C419.722 300.83 419.702 248.89 419.742 196.96C419.752 183.65 429.012 172.09 441.432 169.58C459.402 165.94 475.072 178.21 475.872 196.57C475.942 198.19 475.912 199.82 475.912 201.44C475.912 302.69 475.922 403.93 475.912 505.18C475.912 552.59 448.482 592.62 404.232 609.66C392.242 614.28 379.702 616.51 366.902 616.53C290.262 616.63 213.632 616.67 136.992 616.54C89.372 616.46 46.402 584.09 32.922 538.64C29.702 527.78 28.112 516.73 28.112 505.44C28.092 403.45 28.112 301.45 28.082 199.46C28.082 187.37 32.532 177.83 43.462 171.99C61.482 162.36 84.042 175.51 84.222 195.94C84.462 223.65 84.302 251.37 84.302 279.08C84.302 354.61 84.302 430.14 84.302 505.67C84.302 531.08 99.762 551.74 124.172 558.58C128.322 559.74 132.782 560.28 137.102 560.29C213.742 560.39 290.372 560.41 367.012 560.34C395.652 560.31 419.672 536.13 419.702 507.44C419.762 455.88 419.722 404.32 419.722 352.76Z" />
                        <path d="M251.58 140.97C177.45 140.97 103.33 140.98 29.2 140.96C16.05 140.96 5.07001 133.11 1.64001 121.44C-3.89999 102.6 9.20002 84.9697 29.12 84.8097C50.46 84.6297 71.8 84.7697 93.14 84.7597C107.37 84.7597 121.59 84.6697 135.82 84.8197C139.24 84.8597 140.32 83.8397 140.29 80.3497C140.12 63.7497 140.56 47.1397 140.12 30.5497C139.66 13.4797 152.96 0.739697 170.09 0.789697C224.75 0.959697 279.41 0.839699 334.06 0.869699C348.39 0.879699 358.81 8.2497 362.78 21.4197C363.69 24.4597 363.77 27.8197 363.79 31.0397C363.89 47.0197 363.83 62.9897 363.84 78.9697C363.84 84.7597 363.84 84.7597 369.47 84.7597C404.29 84.7597 439.1 84.7397 473.92 84.7797C486.05 84.7897 495.52 89.7397 500.95 100.83C510.09 119.5 496.49 140.92 475.47 140.94C413.7 141.02 351.93 140.97 290.16 140.97C277.28 140.97 264.43 140.97 251.58 140.97ZM251.92 84.7597C269.15 84.7597 286.37 84.7097 303.6 84.8097C306.65 84.8297 308.18 84.2297 308.05 80.7097C307.8 73.9797 307.89 67.2297 308.02 60.4897C308.07 57.8597 307.12 57.0297 304.54 57.0397C269.46 57.0997 234.39 57.0997 199.31 57.0497C196.9 57.0497 195.98 57.8597 196.03 60.3097C196.14 66.9297 196.25 73.5497 195.99 80.1597C195.85 83.7597 196.99 84.8897 200.62 84.8497C217.72 84.6697 234.82 84.7597 251.92 84.7597Z"/>
                        <path d="M168.082 350.58C168.082 318.14 168.042 285.69 168.092 253.25C168.122 236.71 180.742 224.45 197.192 224.79C211.762 225.09 223.562 237.16 224.222 252.48C224.342 255.35 224.272 258.22 224.272 261.09C224.272 322.86 224.282 384.63 224.262 446.4C224.262 458.98 219.202 468.7 207.492 474.08C189.282 482.46 168.212 469.1 168.122 449.05C167.972 416.22 168.082 383.4 168.082 350.58Z"/>
                        <path d="M335.949 350.88C335.949 383.2 335.989 415.52 335.939 447.84C335.909 464.76 323.099 477.1 306.309 476.54C292.179 476.07 280.519 464 279.799 449.09C279.739 447.84 279.749 446.59 279.749 445.35C279.749 381.83 279.729 318.31 279.759 254.79C279.769 242.04 285.039 232.33 296.979 227.05C314.969 219.09 335.769 232.38 335.879 252.05C336.059 284.99 335.929 317.94 335.929 350.88C335.939 350.88 335.949 350.88 335.949 350.88Z" />
                      </svg>
                  </Link>
                  <button
                    @click="sharePost"
                    class="px-2 py-2 flex items-center hover:bg-gray-100 rounded link-hover"
                    as="button"
                    type="button">
                    <svg class="copy-svg-icon" width="16" height="16" viewBox="0 0 15 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M2.30002 3C2.30002 2.6 2.30002 2.19999 2.30002 1.79999C2.30002 0.899988 2.90002 0.2 3.80002 0C3.90002 0 4.10001 0 4.20001 0C7.20001 0 10.1 0 13.1 0C14.1 0 14.8 0.599976 15 1.59998C15 1.69998 15 1.9 15 2C15 5.4 15 8.89999 15 12.3C15 13.3 14.4 14 13.5 14.2C13.2 14.3 12.8 14.2 12.5 14.3C12.3 14.3 12.2 14.3 12 14.3C12 14.5 12 14.7 12 14.9C11.9 15.9 11.1 16.6 10.1 16.6C8.10001 16.6 6.1 16.6 4 16.6C3.3 16.6 2.59999 16.6 1.89999 16.6C0.899994 16.6 0.2 16 0 15C0 14.9 0 14.8 0 14.6C0 11.4 0 8.2 0 5C0 4 0.600006 3.29998 1.60001 3.09998C1.90001 2.99998 2.10002 3 2.30002 3ZM10.6 9.69998C10.6 8.09998 10.6 6.49999 10.6 4.89999C10.6 4.49999 10.5 4.39999 10.1 4.39999C7.40001 4.39999 4.80001 4.39999 2.10001 4.39999C1.70001 4.39999 1.60001 4.49999 1.60001 4.89999C1.60001 8.09999 1.60001 11.2 1.60001 14.4C1.60001 14.8 1.70001 14.9 2.10001 14.9C4.80001 14.9 7.40001 14.9 10.1 14.9C10.5 14.9 10.6 14.8 10.6 14.4C10.6 12.9 10.6 11.3 10.6 9.69998ZM12.1 12.7C12.4 12.7 12.8 12.7 13.1 12.7C13.5 12.7 13.6 12.6 13.6 12.2C13.6 8.79998 13.6 5.4 13.6 2C13.6 1.6 13.5 1.5 13.1 1.5C10.2 1.5 7.29999 1.5 4.39999 1.5C4.29999 1.5 4.30001 1.5 4.20001 1.5C4.00001 1.5 3.89999 1.59999 3.89999 1.79999C3.89999 2.19999 3.89999 2.6 3.89999 3C3.99999 3 4.00001 3 4.10001 3C6.10001 3 8.10001 3 10.1 3C10.3 3 10.5 2.99998 10.7 3.09998C11.5 3.29998 12.1 4.09999 12.1 4.89999C12.1 7.39999 12.1 10 12.1 12.5C12.1 12.5 12.1 12.6 12.1 12.7Z"/>
                    </svg>
                  </button>
              </div>
            </div>
            <div class="ml-2 pl-2 sm:-mt-5">
              <h1 class="font-semibold text-2xl text-black max-w-md" v-bind:class="{'font-semibold text-2xl text-black': true, 'mt-0': !can_delete}">
                {{ post.data.title }}
              </h1>
              <p class="text-slate-700 pr-4 text-base my-2 w-full" v-html="post.data.description"></p>
              <a
                :href="post.data.url"
                class="font-semibold text-blue-500 text-sm hover:text-blue-300"
                >{{ post.data.url }}</a
              >
            </div>
            <hr />
            <div v-if="$page.props.auth.auth_check">
              <form class="m-2 p-2" @submit.prevent="submit">
                <div class="mt-2 w-full break-all">
                  <label
                    for="comment"
                    class="
                      block
                      mb-2
                      text-sm
                      font-medium
                      text-gray-900
                      dark:text-gray-400
                    "
                    >Ваш комментарий</label
                  >
                  <QuillEditor v-model="form.content" />
                </div>
                <div class="mt-3 flex justify-end">
                  <button
                  :disabled="!form.content.trim() || isSubmitting"
                  class="
                    px-4
                    py-2
                    bg-custom-blue
                    hover:bg-blue-500
                    text-white
                    rounded-md
                    disabled:bg-blue-300
                  "
                  >
                    Отправить
                  </button>
                </div>
              </form>
            </div>
            <div>
              <ul role="list" class="divide-y divide-gray-200 m-2 p-2">
                <div
                  v-for="(comment, index) in reversedComments"
                  :key="index"
                  class="pb-4 pt-2 comment-container"
                >
                  <div class="text-sm flex items-center gap-1">
                    <img :src="comment.avatar_url" alt="" class="contents sm:inline-block rounded-full w-7 h-7 object-cover">
                    <span class="font-semibold text-xs ml-2 sm:ml-1 text-slate-700 w-22 xs">{{
                      comment.name
                    }}
                    </span>
                    <span class="text-gray-500 truncate text-xs"> · {{ comment.created_at }}</span>
                    <div v-if="$page.props.auth.auth_check" class="flex gap-2 ml-auto">
                      <div v-if="comment.user_id === $page.props.auth.user.id" class="ml-auto text-blue-500 cursor-pointer text-xs" @click="editComment(comment)">
                        <div class="px-2 py-2 flex items-center hover:bg-gray-100 rounded link-hover">
                          <svg class="edit-svg-icon" width="15" height="15" viewBox="0 0 394 458" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M393.001 89.0001C392.701 105.9 386.301 120.1 374.201 132C328.101 177.9 282.201 224 236.201 269.9C207.501 298.6 178.501 327 150.201 356.1C137.601 369.1 123.201 377 105.401 380C85.6005 383.3 66.0005 387.7 46.2005 391.7C19.1005 397.1 -3.59948 375.2 1.30052 348.1C5.50052 325.1 10.4005 302.1 15.0005 279.2C17.4005 267.1 23.3005 256.9 32.0005 248.2C104.501 175.8 176.901 103.2 249.501 30.9001C257.401 23.1001 265.201 14.8001 274.401 8.90005C296.001 -4.99995 324.501 -2.09994 343.301 15.2001C355.401 26.4001 366.901 38.2001 378.201 50.2001C388.401 61.0001 392.801 74.2001 393.001 89.0001ZM361.001 87.4001C360.901 81.1001 358.001 74.8001 352.701 69.5001C343.101 59.9001 333.501 50.1001 323.701 40.6001C311.901 29.1001 296.301 29.1001 284.601 40.8001C208.001 117.5 131.301 194.1 54.8005 271C50.8005 275 47.8005 280.9 46.5005 286.4C41.6005 307.8 37.6005 329.3 33.4005 350.8C31.7005 359.5 34.0005 361.6 42.9005 359.9C61.1005 356.3 79.3005 352.3 97.6005 349.1C110.101 347 119.901 341.5 128.901 332.4C194.401 266.4 260.201 200.8 326.001 135.1C334.901 126.2 343.901 117.2 352.801 108.3C358.201 102.9 361.101 96.4001 361.001 87.4001Z"/>
                            <path d="M218.2 457.2C165.6 457.2 113.1 457.2 60.4997 457.2C51.4997 457.2 45.7997 453.6 43.2997 446.4C40.3997 437.7 45.2997 428.3 54.1997 426.1C56.3997 425.5 58.7997 425.4 61.0997 425.4C165.7 425.4 270.4 425.4 375 425.4C384.7 425.4 390.8 429.3 393.1 437.1C395.9 446.3 389.4 456.2 379.8 457.2C377.7 457.4 375.5 457.4 373.3 457.4C321.7 457.2 269.9 457.2 218.2 457.2Z"/>
                          </svg>
                        </div>
                      </div>
                      <div v-if="comment.user_id === $page.props.auth.user.id || user.is_admin == 1" class="ml-auto mr-2 text-red-500 cursor-pointer text-xs" @click="deleteComment(comment.id)">
                        <div class="px-2 py-2 flex items-center hover:bg-gray-100 rounded link-hover">
                          <svg class="delete-svg-icon" width="16" height="16" viewBox="0 0 504 617" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M419.722 352.76C419.722 300.83 419.702 248.89 419.742 196.96C419.752 183.65 429.012 172.09 441.432 169.58C459.402 165.94 475.072 178.21 475.872 196.57C475.942 198.19 475.912 199.82 475.912 201.44C475.912 302.69 475.922 403.93 475.912 505.18C475.912 552.59 448.482 592.62 404.232 609.66C392.242 614.28 379.702 616.51 366.902 616.53C290.262 616.63 213.632 616.67 136.992 616.54C89.372 616.46 46.402 584.09 32.922 538.64C29.702 527.78 28.112 516.73 28.112 505.44C28.092 403.45 28.112 301.45 28.082 199.46C28.082 187.37 32.532 177.83 43.462 171.99C61.482 162.36 84.042 175.51 84.222 195.94C84.462 223.65 84.302 251.37 84.302 279.08C84.302 354.61 84.302 430.14 84.302 505.67C84.302 531.08 99.762 551.74 124.172 558.58C128.322 559.74 132.782 560.28 137.102 560.29C213.742 560.39 290.372 560.41 367.012 560.34C395.652 560.31 419.672 536.13 419.702 507.44C419.762 455.88 419.722 404.32 419.722 352.76Z" />
                            <path d="M251.58 140.97C177.45 140.97 103.33 140.98 29.2 140.96C16.05 140.96 5.07001 133.11 1.64001 121.44C-3.89999 102.6 9.20002 84.9697 29.12 84.8097C50.46 84.6297 71.8 84.7697 93.14 84.7597C107.37 84.7597 121.59 84.6697 135.82 84.8197C139.24 84.8597 140.32 83.8397 140.29 80.3497C140.12 63.7497 140.56 47.1397 140.12 30.5497C139.66 13.4797 152.96 0.739697 170.09 0.789697C224.75 0.959697 279.41 0.839699 334.06 0.869699C348.39 0.879699 358.81 8.2497 362.78 21.4197C363.69 24.4597 363.77 27.8197 363.79 31.0397C363.89 47.0197 363.83 62.9897 363.84 78.9697C363.84 84.7597 363.84 84.7597 369.47 84.7597C404.29 84.7597 439.1 84.7397 473.92 84.7797C486.05 84.7897 495.52 89.7397 500.95 100.83C510.09 119.5 496.49 140.92 475.47 140.94C413.7 141.02 351.93 140.97 290.16 140.97C277.28 140.97 264.43 140.97 251.58 140.97ZM251.92 84.7597C269.15 84.7597 286.37 84.7097 303.6 84.8097C306.65 84.8297 308.18 84.2297 308.05 80.7097C307.8 73.9797 307.89 67.2297 308.02 60.4897C308.07 57.8597 307.12 57.0297 304.54 57.0397C269.46 57.0997 234.39 57.0997 199.31 57.0497C196.9 57.0497 195.98 57.8597 196.03 60.3097C196.14 66.9297 196.25 73.5497 195.99 80.1597C195.85 83.7597 196.99 84.8897 200.62 84.8497C217.72 84.6697 234.82 84.7597 251.92 84.7597Z"/>
                            <path d="M168.082 350.58C168.082 318.14 168.042 285.69 168.092 253.25C168.122 236.71 180.742 224.45 197.192 224.79C211.762 225.09 223.562 237.16 224.222 252.48C224.342 255.35 224.272 258.22 224.272 261.09C224.272 322.86 224.282 384.63 224.262 446.4C224.262 458.98 219.202 468.7 207.492 474.08C189.282 482.46 168.212 469.1 168.122 449.05C167.972 416.22 168.082 383.4 168.082 350.58Z"/>
                            <path d="M335.949 350.88C335.949 383.2 335.989 415.52 335.939 447.84C335.909 464.76 323.099 477.1 306.309 476.54C292.179 476.07 280.519 464 279.799 449.09C279.739 447.84 279.749 446.59 279.749 445.35C279.749 381.83 279.729 318.31 279.759 254.79C279.769 242.04 285.039 232.33 296.979 227.05C314.969 219.09 335.769 232.38 335.879 252.05C336.059 284.99 335.929 317.94 335.929 350.88C335.939 350.88 335.949 350.88 335.949 350.88Z" />
                          </svg>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="text-slate-600 flex text-sm ml-2 mt-2 sm:mt-0 sm:p-2 flex sm:gap-5">
                    <div>
                    </div>
                    <div class="break-all w-full flex flex-col gap-2">
                      <div v-html="comment.content" class="comment-text"></div>
                        <div class="w-full" v-if="editingComment && editingComment.id === comment.id">
                          <div class="h-30 mb-15">
                            <QuillEditor v-model="editingContent" />
                          </div>
                          <div class="flex justify-end">
                            <button
                            @click="saveEdit"
                            class="
                              mt-2
                              px-4
                              py-2
                              bg-custom-blue
                              hover:bg-blue-500
                              text-xs
                              text-white
                              rounded-md
                              disabled:bg-blue-300
                            "
                            >
                            Сохранить
                          </button>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
              </ul>
            </div>
            <hr />
          </div>
        </div>
      </div>
      <div class="w-full md:w-4/12">
        <PostList :posts="posts.data" :community="community">
          <template #title>Популярные треды</template>
        </PostList>
      </div>
    </section>
  </guest-layout>
</template>

<script setup>
import { ref, computed } from 'vue';
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Link, useForm, usePage } from "@inertiajs/vue3";
import PostVote from "@/Components/PostVote.vue";
import PostList from "@/Components/PostList.vue";
import { Inertia } from '@inertiajs/inertia';
import QuillEditor from "@/Components/QuillEditor.vue";
import 'quill/dist/quill.snow.css'; 

const user = usePage().props.auth.user;

const isMenuOpen = ref(false);
const scrollPosition = ref(0); 

const props = defineProps({
  community: Object,
  post: Object,
  posts: Object,
  can_delete: Boolean,
  can_update: Boolean,
});

const form = useForm({
  content: "",
});

const isSubmitting = ref(false); 

const submit = () => {
  scrollPosition.value = window.scrollY; 
  isSubmitting.value = true; 
  form.post(
    route("frontend.posts.comments", [
      props.community.slug,
      props.post.data.slug,
    ]),
    {
      onStart: () => isSubmitting.value = true,
      onFinish: () => {
        isSubmitting.value = false; 
        window.scrollTo(0, scrollPosition.value); 
      },
      onSuccess: () => form.reset("content"),
    }
  );
};

const reversedComments = computed(() => {
  return [...props.post.data.comments].reverse();
});

const editingComment = ref(null);
const editingContent = ref("");

const editComment = (comment) => {
  if (editingComment.value && editingComment.value.id === comment.id) {
    editingComment.value = null;
    editingContent.value = '';
  } else {
    editingComment.value = comment;
    editingContent.value = comment.content;
  }
};

const saveEdit = () => {
  Inertia.put(route('comments.update', { comment: editingComment.value.id }), { content: editingContent.value });
  editingComment.value = null; 
};

const deleteComment = (commentId) => {
  if (!commentId) {
    console.error('Comment ID is required');
    return;
  }
  Inertia.delete(route('comments.destroy', { comment: commentId }));
};

const sharePost = () => {
  const postLink = route('frontend.communities.posts.show', [props.community.slug, props.post.data.slug]);

  navigator.clipboard.writeText(postLink).then(() => {
    alert('Ссылка скопирована в буфер обмена!');
  }).catch(err => {
    console.error('Ошибка при копировании: ', err);
    alert('Не удалось скопировать ссылку');
  });
};
</script>

<style>
.delete-svg-icon {
  fill: black; 
}

.link-hover:hover .delete-svg-icon {
  fill: red; 
}

.edit-svg-icon {
  fill: black;
}

.link-hover:hover .edit-svg-icon {
  fill: #0079D3;
}

.copy-svg-icon {
  fill: black; 
}

.ql-editor {
  min-height: 8rem; 
}

.comment-text::before {
  content: ""; 
  position: absolute; 
  left: 0; 
  top: 50%; 
  transform: translateY(-50%); 
  height: 100%; 
  width: 2px; 
  background-color: #EDEFF1; 
}

.comment-text {
  position: relative; 
  padding-left: 20px; 
}
</style>