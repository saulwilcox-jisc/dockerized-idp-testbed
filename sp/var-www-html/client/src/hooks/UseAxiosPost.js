import { useState, useCallback } from "react";
import axios from "axios";
import useAuth from "../context/auth";

const useAxiosPost = (url, payload) => {
  const { authToken, setAuthToken } = useAuth();
  const [data, setData] = useState();
  const [loading, setLoading] = useState();
  const [error, setError] = useState();
  let payloadWithHeader = payload || {};

  if (authToken) {
    payloadWithHeader = {
      ...payload,
      headers: { Authorization: `Bearer ${authToken.replace(/\"/g, "")}` },
    };
  }

  const postData = useCallback(() => {
    setLoading(true);

    axios
      .post(url, payloadWithHeader)
      .then((res) => {
        if (res.status === 200) {
          setAuthToken(res.data.token);
        }
        setData(res.data);
        setLoading(false);
      })
      .catch((err) => {
        setError(err);
        if (err.response.status === 401) {
          setAuthToken();
          localStorage.removeItem("token");
        }
      });
  }, [url, payload]);

  return [{ data, loading, error }, postData];
};

export default useAxiosPost;
