/* eslint-disable no-param-reassign */
export const clearForm = (data) => {
  // eslint-disable-next-line no-unused-vars
  Object.keys(data).forEach((key, index) => {
    data[key] = '';
  });
};
